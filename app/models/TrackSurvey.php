<?php

class TrackSurvey extends \Eloquent {
	
	protected $table = 'track_surveys';

	protected $fillable = ['location'];

	public static $rules = [
		'location' => 'required|min:3|unique:users'
	];

}