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

	public function showCreate(){
		return View::make('survey.createSurvey');
	}

	public function create(){
		return 'write code to create survey!!';
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
			return Redirect::back()->withSuccess('Survey entry deleted!');
		}

		return Redirect::back()->withError('Survey can\'t be deleted!!');
	}

}