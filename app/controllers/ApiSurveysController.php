<?php

use Sorskod\Larasponse\Larasponse;
use Optimus\Surveys\SurveyTransformer;

class ApiSurveysController extends \BaseController {


	protected $fractal;

    public function __construct(Larasponse $fractal)
    {
        $this->fractal = $fractal;
        // $this->fractal->parseIncludes(Input::get('includes'));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$surveys = Survey::all(); //for testing purpose
		// dd($this->fractal);
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
	                'message' => 'Not found!',
	                'status_code' => 404
	            ]
	        ], 404);
	    }

	    return $this->fractal->item($survey, new SurveyTransformer());
	}


}
