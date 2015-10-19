<?php 

class SurveyController extends BaseController{


	public function index(){

		// $user_id  = Auth::user()->id;

		// return View::make('survey.index')->withSurveys(Survey::where('admin_user_id', $user_id));

		return View::make('survey.index')->withSurveys(Survey::all());

	}

}