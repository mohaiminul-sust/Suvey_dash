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

Route::get('/', ['as'=>'index','uses' => 'PublicController@home']);

// Route::controller('password', 'RemindersController');

Route::group(['before' => 'guest'], function (){
	Route::get('login', ['as'=>'login','uses' => 'UserController@showLogin']);
	Route::post('login', ['uses' => 'UserController@doLogin']);
});

Route::group(array('before' => 'auth'), function(){
	Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@doLogout']);
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));
	Route::get('resetpass', ['as' => 'resetPassword', 'uses' => 'UserController@resetPassword']);
});
