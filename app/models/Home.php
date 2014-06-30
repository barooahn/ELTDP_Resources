<?php

class Home extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public static function showTopResources($limit = 18446744073709551610) 
	{
		$topResources = DB::table('resources')
                    ->orderBy('rating', 'desc')
                    ->take($limit) 
                    ->get();

		return $topResources;
	}

	public static function showNewResources($limit = 18446744073709551610) 
	{
		$newResources = DB::table('resources')
					->orderBy('created_at', 'desc')
					->take($limit) 
                    ->get();

		return $newResources;
	}

}