<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
  return view('home');
});

Route::get('nearby', [
	'as' 	 => 'nearby',
	'uses' => 'AppController@getNearby'
]);

Route::get('/redirect', [
	'as'   => 'oauth-login',
	'uses' => 'AppController@redirect'
]);

Route::get('/auth/logout', [
	'as'   => 'logout',
	'uses' => 'Auth\AuthController@logout'
]);

Route::get('/{provider}/callback', 'AppController@callback');

Route::get('{user}', function(){
	return 'h';
});

Route::post('{user}', function(){
	return 'h';
});