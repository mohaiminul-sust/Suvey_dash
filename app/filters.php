<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});


App::error(function(\Lahaxearnaud\LaravelToken\exeptions\TokenException $exception)
{
    if($exception instanceof \Lahaxearnaud\LaravelToken\exeptions\TokenNotFoundException) {
        return \Response::make('Unauthorized (Not found)', 401);
    }

    if($exception instanceof \Lahaxearnaud\LaravelToken\exeptions\TokenNotValidException) {
        return \Response::make('Unauthorized (Not valid token)', 401);
    }

    if($exception instanceof \Lahaxearnaud\LaravelToken\exeptions\UserNotLoggableByTokenException) {
        return \Response::make('Unauthorized (Not loggable by token)', 401);
    }

    if($exception instanceof \Lahaxearnaud\LaravelToken\exeptions\NotLoginTokenException) {
        return \Response::make('Unauthorized (Not login token)', 401);
    }
});
/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic("username");
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});



Route::filter('admin', function()
{


	if (!Auth::check() || Auth::user()->roles_id != Role::where('type', 'admin')->first()->id){
		
		return Redirect::route('dashboard')->withWarning('Unauthorized access prohibited !!! Log in with an account that has admin privilages.');
		// return 'kabikha  '.Auth::user()->roles_id.'  '.Role::where('type', 'admin')->first()->id;
	}
});



Route::filter('super_admin', function()
{
	if (!Auth::check() || Auth::user()->roles_id != Role::where('type', 'super_admin')->first()->id){
		
		return Redirect::route('dashboard')->withWarning('Unauthorized access prohibited !!! Log in with an account that has super admin privilages.');
		// return 'batabi kha  '.Auth::user()->roles_id.'  '.Role::where('type', 'super_admin')->first()->id;
	}
});
/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
