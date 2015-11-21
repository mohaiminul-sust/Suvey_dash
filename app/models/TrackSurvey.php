<?php

class TrackSurvey extends \Eloquent {
	
	protected $table = 'track_surveys';

	protected $fillable = ['lat', 'lon'];

	public static $rules = [
		'lat' => 'required|numeric',
		'lon' => 'required|numeric'
	];


}