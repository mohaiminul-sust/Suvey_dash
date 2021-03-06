<?php

class Question extends \Eloquent {
	
	protected $table = 'questions';

	protected $fillable = ['type', 'body'];

	public static $addQuestionRules = [
		'questionBody' => 'required|min:5'
	];

	public function survey(){
		return $this->belongsTo('Survey', 'surveys_id');
	}

	public function answer(){
		return $this->hasOne('Answer', 'questions_id');
	}

	public function choices(){
		return $this->hasMany('Choice', 'questions_id');
	}

	public function getChoices(){
		
		$ih=0;
		$tempAra= [];

		foreach ($this->choices as $child) {
			$tempAra[] = ucfirst((string)$child->choice);
		}
		
		return $tempAra;
	}
	
	public function getQuestionCreatedDate(){

	    return $this->created_at->format('d.m.Y');
	
	}
}