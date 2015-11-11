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

// Route::when('*', 'csrf', ['post', 'put', 'patch']);
// App::bind('League\Fractal\Serializer\SerializerAbstract', 'League\Fractal\Serializer\DataArraySerializer');

Route::get('/', ['as'=>'index','uses' => 'PublicController@home']);

Route::group(['prefix'=>'api/v1'], function(){

	Route::post('login', 'UserApiController@authenticate');
	Route::get('userinfo', 'UserApiController@getUserDetails');
	Route::get('logout', 'UserApiController@deauthenticate');

	Route::get('surveys', 'ApiSurveysController@index');
	Route::get('surveys/{id}', 'ApiSurveysController@show');
	
});

Route::group(['before' => 'guest'], function (){
	Route::get('login', ['as'=>'login','uses' => 'UserController@showLogin']);
	Route::post('login', ['as' => 'login','uses' => 'UserController@doLogin']);
});

Route::group(['before' => 'auth'], function(){
	Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@doLogout']);
	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
	// Route::get('resetpass', ['as' => 'resetPassword', 'uses' => 'UserController@resetPassword']);
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
		Route::post('/update', ['as' => 'updateQuestion', 'uses' => 'QuestionController@update']);
		Route::post('/destroy', ['as' => 'destroyQuestion', 'uses' => 'QuestionController@destroy']);
	});

	Route::group(['prefix'=>'response'], function(){

		Route::group(['prefix'=> 'guests'], function(){
			Route::get('/', ['as' => 'guests', 'uses' => 'GuestUsersController@index']);
			Route::post('/destroy', ['as' => 'destroyGuest', 'uses' => 'GuestUsersController@destroy']);
			Route::get('/{guest_id}/surveys', ['as'=> 'showGuestSurvey', 'uses' => 'GuestUsersController@showGuestSurvey']);
			Route::get('/{guest_id}/surveys/{survey_id}', ['as'=> 'showGuestSurveyAnswer', 'uses' => 'GuestUsersController@showGuestSurveyAnswer']);
		});

		Route::group(['prefix'=>'surveys'], function(){
			Route::get('/', ['as'=>'getSurvaysDone', 'uses'=>'SurveyController@getSurvaysDone']);
			Route::get('/{survey_id}', ['as'=>'showSurvaysDone', 'uses'=>'SurveyController@showSurvaysDone']);
		});

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