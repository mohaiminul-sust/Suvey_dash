<?php

class Survey extends \Eloquent {
	
	protected $table = 'surveys';

	protected $fillable = ['title'];

	public static $rules = [
		'title' => 'required|min:5'
	];

	public function getSurveyCreatedDate(){

	    return $this->created_at->format('d.m.Y');
	
	}

	public function getSurveyUpdatedDate(){

	    return $this->updated_at->format('d.m.Y');
	
	}

}