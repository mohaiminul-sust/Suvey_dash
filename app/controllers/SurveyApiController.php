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
		$user = $this->apiKey->guestUser;
		$survey_ids_taken = TrackSurvey::where('users_id', $user)->distinct()->lists('surveys_id');

		//Question count

		
		//inserting custom key-val
		$surveys = Survey::all();
		foreach($surveys as $survey){
			$survey->is_taken = in_array($survey->id, $survey_ids_taken) ? '1':'0';
			$survey->mcq_count = Question::where('surveys_id', $survey->id)->where('type', 'mcq')->count();
			$survey->wr_count = Question::where('surveys_id', $survey->id)->where('type', 'written')->count();
			$survey->taken_by = TrackSurvey::where('surveys_id', $survey->id)->groupBy('users_id')->lists('users_id');			
		}

		// return $surveys;
		return Fractal::collection($surveys, new SurveyTransformer);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){

		$user = $this->apiKey->guestUser;
		$survey_ids_taken = TrackSurvey::where('users_id', $user)->distinct()->lists('surveys_id');

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

	    $survey->is_taken = in_array($survey->id, $survey_ids_taken) ? '1':'0';
		$survey->mcq_count = Question::where('surveys_id', $survey->id)->where('type', 'mcq')->count();
		$survey->wr_count = Question::where('surveys_id', $survey->id)->where('type', 'written')->count();
		$survey->taken_by = TrackSurvey::where('surveys_id', $survey->id)->groupBy('users_id')->lists('users_id');	

	    return Fractal::item($survey, new SurveyTransformer());
	}


}
