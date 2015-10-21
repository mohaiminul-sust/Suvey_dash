<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admin_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $fillable = ['username'];

	public static $rules = [
		'username' => 'required|min:3',
		'password' => 'required|alpha_num|between:8,12|confirmed',
		'password_confirmation' => 'required|alpha_num|between:8,12'
	];

	public function getAdminCreatedDate(){
		 return $this->created_at->format('d.m.Y');
	}

	public function getAdminUpdatedDate(){
		 return $this->updated_at->format('d.m.Y');
	}


	public function surveys(){
		return $this->hasMany('Survey', 'admin_users_id');
	}

	public function getSurveyCount(){
		return $this->surveys->count();
	}

	public function role(){
		return $this->belongsTo('Role', 'roles_id');
	}
}
