<?php

class Question extends \Eloquent {
	
	protected $table = 'questions';

	protected $fillable = ['type', 'body'];

}