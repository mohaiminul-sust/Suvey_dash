<?php

use Optimus\Questions\QuestionTransformer;
use Chrisbjr\ApiGuard\Controllers\ApiGuardController;

class QuestionApiController extends ApiGuardController {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	// protected $apiMethods = [
 //        'index' => [
 //            'keyAuthentication' => false
 //        ],
 //    ];

	public function index($survey_id)
	{
		$questions = Survey::find($survey_id)->questions;

		return Fractal::collection($questions, new QuestionTransformer);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($survey_id, $id)
	{
		$question = Question::where('surveys_id', $survey_id)->where('id', $id)->first();
		
	    if (!$question)
	    {
	        return Response::json([
	            'error' => [
	                'message' => 'Not found!',
	                'status_code' => 404
	            ]
	        ], 404);
	    }

	    return Fractal::item($question, new QuestionTransformer);
	}


}
