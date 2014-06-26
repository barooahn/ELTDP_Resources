<?php

class YearsController extends \BaseController {

	/**
	 * Display a listing of years
	 *
	 * @return Response
	 */
	public function index()
	{
		$years = Year::all();

		return View::make('years.index', compact('years'));
	}

	/**
	 * Show the form for creating a new year
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('years.create');
	}

	/**
	 * Store a newly created year in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Year::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Year::create($data);

		return Redirect::route('years.index');
	}

	/**
	 * Display the specified year.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$year = Year::findOrFail($id);

		return View::make('years.show', compact('year'));
	}

	/**
	 * Show the form for editing the specified year.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$year = Year::find($id);

		return View::make('years.edit', compact('year'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$year = Year::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Year::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$year->update($data);

		return Redirect::route('years.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Year::destroy($id);

		return Redirect::route('years.index');
	}

}