<?php

class GuestUser extends \Eloquent {
	
	protected $table = 'users';

	protected $fillable = ['email'];

	protected $hidden = ['password'];

	public static $rules = [
		'email' => 'required|email|unique:users',
		'password' => 'required|alpha_num|between:8,12'
	];

	public function getGuestCreatedDate(){
		return $this->created_at->format('d.m.Y');
	}	

	public function getSurveyTakenCount($guestId){

		return TrackSurvey::where('users_id', $guestId)->count();
	}

}