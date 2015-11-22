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

		
		try {
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
		
		} catch (Exception $e) {
           
           	return $this->response->errorGone();
			
		}
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

	    if ($survey)
	    {
	    	$survey->is_taken = in_array($survey->id, $survey_ids_taken) ? '1':'0';
			$survey->mcq_count = Question::where('surveys_id', $survey->id)->where('type', 'mcq')->count();
			$survey->wr_count = Question::where('surveys_id', $survey->id)->where('type', 'written')->count();
			$survey->taken_by = TrackSurvey::where('surveys_id', $survey->id)->groupBy('users_id')->lists('users_id');	

		    return Fractal::item($survey, new SurveyTransformer());
    
	    }

	    
        return $this->response->errorNotFound();

	}

	public function submit($id){

		$user = $this->apiKey->guestUser;

		if($user){

			$validator = Validator::make(Input::all(), TrackSurvey::$rules);

			if($validator->passes()){

				$trackSurvey = new TrackSurvey;
				$trackSurvey->users_id = $user->id;
				$trackSurvey->surveys_id = $id;
				$trackSurvey->lat = Input::get('lat');
				$trackSurvey->lon = Input::get('lon');

				try {
					
					$surveyAnswers = Input::get('answers');

					foreach ($surveyAnswers as $surveyAnswer) {
						
						// return $surveyAnswer['body'];
						$answer = new Answer;
						$answer->body = $surveyAnswer['body'];
						$answer->questions_id = $surveyAnswer['questions_id'];
						$answer->users_id = $user->id;
						$answer->save();
					}					

				} catch (Exception $e) {
            			
            		return $this->response->errorInternalError("failed saving answers");
					
				}

				try {

					$trackSurvey->save();

					return Response::json([
		                'success' => [
		                    'message' => 'Survey answers and tracking info updated !',
		                    'status_code' => 200
		                ]
		            ], 200);

				} catch (Exception $e) {
            			
            		return $this->response->errorInternalError("tracking info not saved.failed saving answers.");
						
				}

			}

        	return $this->response->errorWrongArgsValidator($validator);
		}

        return $this->response->errorUnauthorized("No such user found with submit permit");

	}


}
