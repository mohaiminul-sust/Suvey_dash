<?php

class GuestUser extends \Eloquent {
	
	protected $table = 'users';

	protected $fillable = ['username'];

	protected $hidden = ['password'];

	public static $rules = [
		'username' => 'required|min:3|unique:users',
		'password' => 'required|alpha_num|between:8,12'
	];

}