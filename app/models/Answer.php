<?php

class Answer extends \Eloquent {
	
	protected $table = 'answers';

	protected $fillable = ['body'];

	public function question(){
		$this->belongsTo('Question');
	}
}