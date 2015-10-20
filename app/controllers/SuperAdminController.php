<?php 

class SuperAdminController extends BaseController{


	public function index()
	{
		$admin_roles_id = Role::where('type', 'admin')->first()->id;
		$admins = User::where('roles_id', $admin_roles_id)->get();

		return View::make('superadmin.index')->withAdmins($admins);
	}

	public function destroyAdmin(){

		$admin = User::find(Input::get('adminId'));

		if($admin){
			$admin->delete();
			return Redirect::back()->withSuccess('Admin entry deleted!');
		}

		return Redirect::back()->withError('Admin entry can\'t be deleted!!'); 
	}

}