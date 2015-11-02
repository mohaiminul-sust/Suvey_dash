<?php 

class SurveyController extends BaseController{


	public function index(){

		if(Auth::user()->role->type == 'super_admin'){
			
			return View::make('survey.index')->withSurveys(Survey::all())->with('user_type', Auth::user()->role->type);

		}else if(Auth::user()->role->type == 'admin'){

			return View::make('survey.index')
				->withSurveys(Survey::where('admin_users_id', Auth::user()->id)->get())
				->with('user_type', Auth::user()->role->type);

		}

	}

	public function show($id){

		$survey = Survey::find($id);

		return View::make('survey.show')->withSurvey($survey);

	}

	public function getSurvaysDone(){

		if(Auth::user()->role->type == 'admin'){
			$survey_ids = Survey::where('admin_users_id', Auth::user()->id)->lists('id');
			$trackSurveys = DB::table('track_surveys')->whereIn('surveys_id', $survey_ids)->groupby('surveys_id')->get();

			// return $trackSurveys;
			return View::make('survey.done')->with('track_surveys', $trackSurveys);

		}else if(Auth::user()->role->type == 'super_admin'){
			$trackSurveys = DB::table('track_surveys')->groupby('surveys_id')->get();

			// return $trackSurveys;
			return View::make('survey.done')->with('track_surveys', $trackSurveys);

		}
	}

	public function showSurvaysDone($survey_id){
		
			$survey = Survey::find($survey_id);
		
			// $trackSurvey = DB::table('track_surveys')->where('surveys_id', $survey_id)->get();
			// return $survey;

			$ques_ids = Question::where('surveys_id', $survey_id)->lists('id'); 
			$perQACount = Answer::whereIn('questions_id', $ques_ids)->groupby('questions_id')->get()->count();

			// return $perQACount;
			return View::make('survey.showDone')->withSurvey($survey)->with('QA_count', $perQACount);
		
	}

	public function create(){

		$validator = Validator::make(Input::all(), Survey::$createSurveyRules);

		if($validator->passes()){

			$survey = new Survey;
			$survey->title = Input::get('surveyTitle');
			$survey->admin_users_id = Auth::user()->id;
			$survey->save();

			return Redirect::route('showSurvey', $survey->id)->withSuccess('Survey Created Successfully!! Add questions to your survey !');
		}

		return Redirect::back()
			->withError('Validation Errors Occured !')
			->withErrors($validator)
			->withInput();
	
	}

	public function rename(){

		$survey = Survey::find(Input::get('surveyId'));
		$survey->title = Input::get('surveyTitle');
		$survey->save();

		return Redirect::back()->withSuccess('Survey renamed to \''.$survey->title.'\'');
	
	}

	public function destroy(){

		$survey = Survey::find(Input::get('surveyId'));

		if($survey){
			$survey->delete();
			return Redirect::route('surveys')->withSuccess('Survey entry deleted!');
		}

		return Redirect::route('surveys')->withError('Survey can\'t be deleted!!');
	}

}