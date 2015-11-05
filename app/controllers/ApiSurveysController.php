<?php

use Optimus\Surveys\SurveyTransformer;

class ApiSurveysController extends \BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
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
