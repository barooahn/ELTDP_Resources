<?php

class ResourcesController extends \BaseController {

	/**
	 * Display a listing of resources
	 *
	 * @return Response
	 */

	protected $resource;

	public function __construct(Resource $resource)
	{
		$this->resource = $resource;
		$this->beforeFilter('auth', array('except' => array('index', 'show'))); 
        $this->beforeFilter('csrf', array('on' => 'post'));
	}

	public function index()
	{
		$resources = Resource::orderBy('created_at', 'DESC')->paginate(10);

		return View::make('resources.index', array('resources' => $resources));
	}

	/**
	 * Show the form for creating a new resource
	 *
	 * @return Response
	 */

	public function create() 
	{

	  	
	  	// queries the schools db table, orders by type and lists type and id
	  	$school_options = DB::table('schools')->orderBy('type', 'asc')->lists('type','type');
	  	$year_options = DB::table('years')->orderBy('year', 'asc')->lists('year','year');
	  	$unit_options = DB::table('units')->orderBy('unit', 'asc')->lists('unit','unit');
	  	$resourceTypes_options = DB::table('resource_types')->orderBy('type', 'asc')->lists('type','type');

	  	$options = [

	  		'school_options' => $school_options, 
	  		'year_options' => $year_options, 
	  		'unit_options' =>  $unit_options,
	  		'resourceType_options' => $resourceTypes_options
	  	];

	    return View::make('resources.create', array('options' => $options));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$validator = Validator::make($data = Input::all(), Resource::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput()->with('message', 'Validor failed.');;
		}

		if (Input::file('file'))
		{
			$file = Input::file('file');

			$extension = $file->getClientOriginalExtension();
			$destinationPath = 'eltdpResources';
			$filename = preg_replace('/\s+/', '_', $data['name']);
			$uploadSuccess = $file->move($destinationPath, $filename .'.'. $extension);
				
			if ($uploadSuccess) {

				$data['picture'] = Resource::getExtensionType($file, $destinationPath, $filename);

				$data['file'] = $destinationPath .'/'. $filename .'.'. $extension;

				$resourceId = $this->resource->create($data)->id;

				return Redirect::route('resources.show', $resourceId)
				->with('message', 'Resource saved.');

			}

			else {

				return Redirect::back()
					->withInput()
					->withErrors($Validator)
					->with('message', 'Please upload a file.');
			}


		}else {

			return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('message', 'Failed upload.  Please try again.');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$resource = Resource::findOrFail($id);
		// Get all reviews that are not spam for the resource and paginate them
  		$reviews = $resource->reviews()->with('user')->approved()->notSpam()->orderBy('created_at','desc')->paginate(100);

		return View::make('resources.show', array('resource'=>$resource,'reviews'=>$reviews));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$resource = Resource::find($id);

		return View::make('resources.edit', compact('resource'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$resource = Resource::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Resource::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$resource->update($data);

		return Redirect::route('resources.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Resource::destroy($id);

		return Redirect::route('resources.index');
	}


	// Route that handles submission of review - rating/comment

	public function postReview($id)
	{

	  $input = array(
		'comment' => Input::get('comment'),
		'rating'  => Input::get('rating')
	  );
	  // instantiate Rating model
	  $review = new Review;

	  // Validate that the user's input corresponds to the rules specified in the review model
	  $validator = Validator::make( $input, Review::$rules);

	  // If input passes validation - store the review in DB, otherwise return to product page with error message 
	  if ($validator->passes()) {
		$review->storeReviewForProduct($id, $input['comment'], $input['rating']);
		return Redirect::to('resources/'.$id.'#reviews-anchor')->with('review_posted',true);
	  }

	  return Redirect::to('resources/'.$id.'#reviews-anchor')->withErrors($validator)->withInput();
	}

	public function makePublic($id)
	{
		$resource = Resource::findOrFail($id);
		$resource->private = 0;
		$resource->save();
		return View::make('users.show');
	}

	public function makePrivate($id)
	{
		$resource = Resource::findOrFail($id);
		$resource->private = 1;
		$resource->save();
		return View::make('users.show');
	}
}