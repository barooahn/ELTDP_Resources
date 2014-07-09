<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('home', function()
{
	return View::make('home');
});

Route::get('user/profile', array('as' => 'profile', function()
{
    //
}));

Route::get('search', array('as' => 'search', function()
{
	$query = Request::get('q');

	$users = User::search($query)->get();

	if(count($users) > 0) {
	
		return View::make('users.index')->withUsers($users);
		
	} else {
		
	$resources = Resource::search($query)->get();

	return View::make('resources.index')->withResources($resources);
	}

}));

Route::get('login', array('as' => 'login', 'uses' =>'UsersController@getLogin'));

Route::post('login', 'UsersController@postLogin');

Route::get('register', 'UsersController@create');

Route::get('logout', 'UsersController@getLogout');

Route::resource('resources', 'ResourcesController');

Route::resource('schools', 'SchoolsController');

Route::resource('years', 'YearsController');

Route::resource('units', 'UnitsController');

Route::resource('type', 'TypeController');

Route::resource('users', 'UsersController');