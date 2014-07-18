<?php

class ReviewsController extends \BaseController {

	/**
	 * Display a listing of reviews
	 *
	 * @return Response
	 */
	public function index()
	{
		$reviews = Review::all()->paginate(10);

		return View::make('reviews.index', compact('reviews'));
	}

	/**
	 * Show the form for creating a new review
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('reviews.create');
	}

	/**
	 * Store a newly created review in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Review::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Review::create($data);

		return Redirect::route('reviews.index');
	}

	/**
	 * Display the specified review.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$review = Review::findOrFail($id);

		return View::make('reviews.show', compact('review'));
	}

	/**
	 * Show the form for editing the specified review.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$review = Review::find($id);

		return View::make('reviews.edit', compact('review'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$review = Review::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Review::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$review->update($data);

		return Redirect::route('reviews.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Review::destroy($id);

		return Redirect::route('reviews.index');
	}

}