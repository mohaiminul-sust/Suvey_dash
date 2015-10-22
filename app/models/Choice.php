<?php

class Choice extends \Eloquent {
	
	protected $table = 'choices';

	protected $fillable = ['choice'];

	public function question(){
		$this->belongsTo('Question' , 'questions_id');
	}
}