<?php

use Optimus\Surveys\SurveyTransformer;
use Chrisbjr\ApiGuard\Controllers\ApiGuardController;

class SurveyApiController extends ApiGuardController {



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

	public function index()
	{
		//User based filtering
		// $user = $this->apiKey->guestUser;
		// $survey_ids = TrackSurvey::where('users_id', $user->id)->lists('surveys_id');
		// $surveys = Survey::find($survey_ids); 

		//all
		$surveys = Survey::all();

		return Fractal::collection($surveys, new SurveyTransformer);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$survey = Survey::find($id);

	    if (!$survey)
	    {
	        return Response::json([
	            'error' => [
	                'message' => 'Not found!',
	                'status_code' => 404
	            ]
	        ], 404);
	    }

	    return Fractal::item($survey, new SurveyTransformer());
	}


}