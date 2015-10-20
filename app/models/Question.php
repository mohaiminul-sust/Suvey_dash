<?php

class Question extends \Eloquent {
	
	protected $table = 'questions';

	protected $fillable = ['type', 'body'];

	public function survey(){
		return $this->belongsTo('Survey');
	}

	public function answer(){
		return $this->hasOne('Answer', 'questions_id');
	}

}