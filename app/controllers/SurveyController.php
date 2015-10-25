<?php 

class SurveyController extends BaseController{


	public function index(){

		$user_type= Role::where('id', Auth::user()->roles_id)->first()->type;

		if($user_type == 'super_admin'){
			
			return View::make('survey.index')->withSurveys(Survey::all())->with('user_type', $user_type);

		}else if($user_type == 'admin'){

			$user_id  = Auth::user()->id;
			// return $user_id;
			return View::make('survey.index')
				->withSurveys(Survey::where('admin_users_id', $user_id)->get())
				->with('user_type', $user_type);

		}

	}

	public function show($id){

		$survey = Survey::find($id);

		return View::make('survey.show')->withSurvey($survey);
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