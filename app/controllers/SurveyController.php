<?php 

class SurveyController extends BaseController{


	public function index(){

		$user_type= Role::where('id', Auth::user()->roles_id)->first()->type;

		if($user_type == 'super_admin'){
			
			return View::make('survey.index')->withSurveys(Survey::all());

		}else if($user_type == 'admin'){

			$user_id  = Auth::user()->id;
			// return $user_id;
			return View::make('survey.index')->withSurveys(Survey::where('admin_users_id', $user_id)->get());

		}

	}

	public function show($id){

		return View::make('survey.show')->withProduct(Product::find($id));
	}

	public function renameSurvey(){
		$survey = Survey::find(Input::get('surveyId'));
		$survey->title = Input::get('surveyTitle');
		$survey->save();

		return Redirect::back()->withSuccess('Survey renamed to \''.$survey->title.'\'');
	}

	public function destroy($id){

		$survey = Survey::find($id);

		if($survey){
			$survey->delete();
			return Redirect::back()->withInfo('Survey entry deleted!');
		}

		return Redirect::back()->withInfo('Survey can\'t be deleted!!');
	}

}