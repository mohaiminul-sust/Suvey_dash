<?php 

class SuperAdminController extends BaseController{


	public function index()
	{
		$admin_roles_id = Role::where('type', 'admin')->first()->id;
		$admins = User::where('roles_id', $admin_roles_id)->get();

		return View::make('superadmin.index')->withAdmins($admins);
	}

	public function showCreateAdmin(){
		return View::make('superadmin.createAdmin');
	}

	public function createAdmin(){
		$validator = Validator::make(Input::all(), User::$rules);

		if($validator->passes()){

			$admin = new User;
			$admin->username = Input::get('username');
			$admin->password = Hash::make(Input::get('password'));
			$admin->roles_id = Role::where('type', 'admin')->first()->id;
			$admin->save();

			return Redirect::route('manageAdmins')->withSuccess('New admin \''.$admin->username.' created successfully!!');
		}

		return Redirect::back()
			->withError('Validation Errors Occured !')
			->withErrors($validator)
			->withInput();
	}

	public function updateAdmin(){
		
		$admin = User::find(Input::get('adminId'));
		$validator = Validator::make(Input::all(), User::$rules);

		if($validator->passes()){

			if(Hash::check(Input::get('oldpass'), $admin->password)){

				$admin->username = Input::get('username');
				$admin->password = Hash::make(Input::get('password'));
				$admin->save();

				return Redirect::back()->withSuccess('Entry Updated');

			}

			return Redirect::back()->withError('Old password didn\'t match with record !');
		
		}

		return Redirect::back()
			->withError('Validation Errors Occured !')
			->withErrors($validator)
			->withInput();

	}

	public function destroyAdmin(){

		$admin = User::find(Input::get('adminId'));

		if($admin){
			$admin->delete();
			return Redirect::back()->withWarning('Admin entry deleted!');
		}

		return Redirect::back()->withError('Admin entry can\'t be deleted!!'); 
	}

}