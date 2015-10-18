<?php 

class UserController extends BaseController{


	public function showLogin(){

		return View::make('login')
						->with('title', 'Login');
	}

	public function doLogin(){
		
		$validation = Validator::make(Input::all(), User::$rules);

		
		if($validation->passes()){



			$credentials = [
				'username'	=>	Input::get('username'),
				'password'	=>	Input::get('password')
				
			];

			if (Auth::attempt($credentials))
			{

			    return Redirect::intended('dashboard')->withInfo(Auth::user()->username.' logged in successfully!');

			}
			else
			{
				return Redirect::route('login')
					->withInput()
					->withErrors('Error in Email Address or Password.');
			}

		}
		else{
			
			return Redirect::route('login')
				->withInput()
				->withErrors($validation);
			
		}
	}

	public function doLogout(){
		
		Auth::logout();

		return Redirect::route('login')
							->with('success', 'You have successfully logged out');
	}

	public function resetPassword(){

		return View::make('password.reset')->with('title', 'Password Reset');;
	}

	public function resetDone(){

		$credentials = Input::only(
			'username', 'password', 'password_confirmation'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}
}