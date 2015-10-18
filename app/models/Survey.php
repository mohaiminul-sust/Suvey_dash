<?php

class Survey extends \Eloquent {
	
	protected $table = 'surveys';

	protected $fillable = ['title'];

	public static $rules = [
		'title' => 'required|min:5'
	];

}