<?php 

class UserController extends BaseController{


	public function showLogin(){

		return View::make('login')
					->with('title', 'Login');
	}

	public function doLogin(){
		// dd(Input::all());
		$credentials = [
			'username'	=>	Input::get('username'),
			'password'	=>	Input::get('password')
			
		];

		$remember = (Input::has('remember')) ? true :false;

		if (Auth::attempt($credentials, $remember)){

		    return Redirect::intended('dashboard')->withInfo(Auth::user()->username.' logged in successfully!');

		}
		else{
			
			return Redirect::route('login')
				->withInput()
				->withErrors('Wrong Email Address or Password !');
		
		}
	}

	public function doLogout(){
		
		Auth::logout();

		return Redirect::route('login')
							->with('success', 'You have successfully logged out');
	}

}