<?php

class Role extends \Eloquent {
	
	protected $table = 'roles';

	protected $fillable = ['type'];

	public static $rules = [
		'type' => 'required|min:3'
	];

	public function users(){
		return $this->hasMany('User', 'roles_id');
	}


}