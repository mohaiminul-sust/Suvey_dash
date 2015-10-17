<?php

class GuestUser extends \Eloquent {
	
	protected $fillable = ['username'];

	public static $rules = [
		'username' => 'required|min:2|unique:admin_users',
		'password' => 'required|alpha_num|between:8,12'
	];

}