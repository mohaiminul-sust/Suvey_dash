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
	Route::post('login', ['as' => 'login','uses' => 'UserController@doLogin']);
});

Route::group(['before' => 'auth'], function(){
	Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@doLogout']);
	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
	Route::get('resetpass', ['as' => 'resetPassword', 'uses' => 'UserController@resetPassword']);
});

Route::group(['before' => 'auth'], function(){

	Route::group(['prefix' => 'surveys'], function(){
		Route::get('/', ['as' => 'surveys', 'uses' => 'SurveyController@index']);
		Route::post('/create', ['as' => 'createSurvey', 'uses' => 'SurveyController@create']);
		Route::post('/rename', ['as' => 'renameSurvey', 'uses' => 'SurveyController@rename']);
		Route::post('/destroy', ['as' => 'destroySurvey', 'uses' => 'SurveyController@destroy']);
		Route::get('/show/{id}', ['as' => 'showSurvey', 'uses' => 'SurveyController@show']);
	});

	Route::group(['prefix' => 'questions'], function(){
		Route::post('/create', ['as' => 'createQuestion', 'uses' => 'QuestionController@create']);
		// Route::post('/rename', ['as' => 'renameSurvey', 'uses' => 'SurveyController@rename']);
		// Route::post('/destroy', ['as' => 'destroySurvey', 'uses' => 'SurveyController@destroy']);
		// Route::get('/show/{id}', ['as' => 'showSurvey', 'uses' => 'SurveyController@show']);
	});

});

Route::group(['before' => 'super_admin'], function(){

	Route::group(['prefix' => 'superadmin/manage'], function(){
		Route::get('/admins', ['as' => 'manageAdmins', 'uses' => 'SuperAdminController@index']);
		Route::post('/admins/update', ['as' => 'updateAdmin', 'uses' => 'SuperAdminController@updateAdmin']);
		Route::post('/admins/destroy', ['as' => 'destroyAdmin', 'uses' => 'SuperAdminController@destroyAdmin']);
		Route::get('/admins/createform', ['as' => 'showCreateAdmin', 'uses' => 'SuperAdminController@showCreateAdmin']);
		Route::post('/admins/create', ['as' => 'createAdmin', 'uses' => 'SuperAdminController@createAdmin']);
	});

});