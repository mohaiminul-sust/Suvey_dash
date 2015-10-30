<?php 

class GuestUsersController extends BaseController{


	public function index(){
		// return 'guests';
		if(Auth::user()->role->type == 'super_admin'){

			return View::make('guest.index')->withGuests(GuestUser::all());
	
		}else if (Auth::user()->role->type == 'admin'){
			
			$survey_ids = Survey::where('admin_users_id', Auth::user()->id)->lists('id');
			$user_ids = TrackSurvey::where('surveys_id', $survey_ids)->lists('users_id');
			
			$guests = GuestUser::find($user_ids);
			// return $guests;
			return View::make('guest.index')->withGuests($guests);
		}

	}

	public function destroy(){
		// dd(Input::all());
		$guest = GuestUser::find(Input::get('guestId'));

		if($guest){

			$guest->delete();

			return Redirect::back()->withSuccess('Guest deleted !');
		}

		return Redirect::back()->withError('Can\'t delete guest !');
	}
	
}