<?php

class Role extends \Eloquent {
	
	protected $table = 'roles';

	protected $fillable = ['type'];

	public static $rules = [
		'type' => 'required|min:3'
	];

	public function user(){
		return $this->belongsTo('User');
	}

}