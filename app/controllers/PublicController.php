<?php 

class PublicController extends BaseController{


	public function home()
	{
		return Redirect::route('dashboard');
	}

}