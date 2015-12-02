<?php 

class GuestUsersController extends BaseController{


	public function index(){
		// return 'guests';
		if(Auth::user()->role->type == 'super_admin'){

			return View::make('guest.index')->withGuests(GuestUser::all());
	
		}else if (Auth::user()->role->type == 'admin'){

			$survey_ids = Survey::where('admin_users_id', Auth::user()->id)->lists('id');
			// return $survey_ids;
			$guests_id = DB::table('track_surveys')->whereIn('surveys_id', $survey_ids)->distinct()->lists('users_id');
			// return $guests_id;
			$guests = GuestUser::find($guests_id);
			// return $guests;
			return View::make('guest.index')->withGuests($guests);
		}

	}

	public function showGuestSurvey($guest_id){
		// return 'Achi '.$guest_id;
		if(Auth::user()->role->type == 'super_admin'){
			
			$trackSurveys = TrackSurvey::where('users_id', $guest_id)->get();
			
			if($trackSurveys->isEmpty()){
				return Redirect::back()->withError('No survey completed yet!');
			}

			return View::make('guest.survey')->with('track_surveys' ,$trackSurveys)->withGuest(GuestUser::find($guest_id));

		}else if (Auth::user()->role->type == 'admin') {
			
			$survey_ids = Survey::where('admin_users_id', Auth::user()->id)->lists('id');
			$trackSurveys = DB::table('track_surveys')->where('users_id', $guest_id)->whereIn('surveys_id', $survey_ids)->get();
			
			return View::make('guest.survey')->with('track_surveys' ,$trackSurveys)->withGuest(GuestUser::find($guest_id));

		}
	}

	public function showGuestSurveyAnswer($guest_id, $survey_id){

		$guest = GuestUser::find($guest_id);
		$survey = Survey::find($survey_id);
		$trackSurvey = TrackSurvey::where('users_id', $guest_id)->where('surveys_id', $survey_id)->get();
		// return $trackSurvey;
		return View::make('guest.answers')->with('track_survey', $trackSurvey)->withSurvey($survey)->withGuest($guest);
	}

	public function destroy(){

		$guest = GuestUser::find(Input::get('guestId'));

		if($guest){

			$guest->delete();
			return Redirect::back()->withSuccess('Guest deleted !');
		
		}

		return Redirect::back()->withError('Can\'t delete guest !');
	}
	
}