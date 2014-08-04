<?php

class UsersController extends BaseController {

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->all();

		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			
			$user = new User;
			$user->name = $input['name'];
			$user->email = $input['email'];
			$user->password =  Hash::make($input['password']);
			$user->user_key = hash('sha512', $user->name);
			$user->save();

			

		    if($user){
			    $data = [ 'user' => $user, 'key' => $user->user_key];
			 
			    // email view, data for view, closure to send email
			    Mail::send('emails/auth/welcome', $data, function($message) use($user)
			    {
			        $message
			            ->to($user->email)
			            ->subject('Welcome to ELTDP!');
			            //->attach('images/bieberPhoto.jpg');
			    });
			 
			    return View::make('users.checkEmail', compact('user'));
			}else {
				return 'no user';
			}



			return Redirect::route('users.show', $userId);
		}

		return Redirect::route('users.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->find($id);

		if($user){

			return View::make('users.show', compact('user'));
		} else {
			return Redirect::to(URL::previous());
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);

		if (is_null($user))
		{
			return Redirect::route('users.index');
		}

		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');

		$validation = Validator::make($input, User::$rulesUpdate);

		if ($validation->passes())
		{
			$user = $this->user->find($id);
			$user->update($input);
			return Redirect::route('users.show', $id);
		}

		return Redirect::route('users.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->user->find($id)->delete();

		return Redirect::route('users.index');
	}

		public function getLogin()
	{
        return View::make('users.login');
	}

		public function postLogin()
	{

        $input = Input::all();

        $validation = Validator::make($input, array('email' => 'required|email', 'password' =>'required'));

		if ($validation->passes()) {

			$credentials = array('email' => $input['email'], 'password' => $input['password'], 'verified' => 1);


			if(Auth::attempt($credentials)) {

				return Redirect::intended(URL::route('users.show', array(Auth::user()->id)));


			} else 	{

			return Redirect::to('login')
		        ->with('message', 'Your username/password combination was incorrect')
		        ->withInput();
			}

		}

		return Redirect::to('login')
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::to('home')->with('message', 'You are now logged out.');

	}

	public function getConfirm() {
		// Confirm Email-address
		$email = Input::get('email');
		$key = Input::get('key');

		$column = 'email'; // This is the name of the column you wish to search

       	$user = User::where($column , '=', $email)->first();

		if($user->user_key !== $key)
		{
				// Redirect to error page or something
				return Redirect::to('login')->with('warning', 'Please check your email address and click the link. <br/> Your account is still not activated!');
		}

		// Activate the recipient and clear the validation key
		$user->verified = true;
		$user->user_key = '';
		$user->save();
		// display success message
		return Redirect::to('login')->with('message', 'Your account is now activated.');
	}

	public function addToUser($resource_id){
		$resource = Resource::findOrFail($resource_id);
		$user = Auth::user();

		if (!$user->resource->contains($resource->id)) {
		    $user->resource()->save($resource);
		    return Redirect::back()->with('message', "$resource->name Added to your account.");
		}
		
		return Redirect::back()->with('warning', "$resource->name already in your account.");
	}

	public function removeFromUser($resource_id){
		$resource = Resource::findOrFail($resource_id);
		$user = Auth::user();
	    $user->resource()->detach($resource);
	    return Redirect::back()->with('message', "$resource->name removed from your account.");
	}
}
