<?php

class ResourceTypesController extends \BaseController {

	/**
	 * Display a listing of resourcetypes
	 *
	 * @return Response
	 */
	public function index()
	{
		$resourcetypes = Resourcetype::all();

		return View::make('resourcetypes.index', compact('resourcetypes'));
	}

	/**
	 * Show the form for creating a new resourcetype
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('resourcetypes.create');
	}

	/**
	 * Store a newly created resourcetype in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Resourcetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Resourcetype::create($data);

		return Redirect::route('resourcetypes.index');
	}

	/**
	 * Display the specified resourcetype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$resourcetype = Resourcetype::findOrFail($id);

		return View::make('resourcetypes.show', compact('resourcetype'));
	}

	/**
	 * Show the form for editing the specified resourcetype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$resourcetype = Resourcetype::find($id);

		return View::make('resourcetypes.edit', compact('resourcetype'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$resourcetype = Resourcetype::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Resourcetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$resourcetype->update($data);

		return Redirect::route('resourcetypes.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Resourcetype::destroy($id);

		return Redirect::route('resourcetypes.index');
	}

}