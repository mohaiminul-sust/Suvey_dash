<?php

use Sorskod\Larasponse\Larasponse;
use Optimus\SurveyTransformer;

class ApiSurveyController extends \BaseController {


	protected $fractal;

	public function __construct(Larasponse $fractal)
    {
        $this->fractal = $fractal;
    }
	



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$surveys = Survey::all();
		return $this->fractal->collection($surveys, new SurveyTransformer());
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
	                'message' => 'Survey not found!',
	                'status_code' => 404
	            ]
	        ], 404);
	    }

	    return $this->fractal->item($survey, new SurveyTransformer());
	}


}
