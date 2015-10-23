<?php 

class QuestionController extends BaseController{


	public function create(){

		$validator = Validator::make(Input::all(), Question::$rules);

		if($validator->passes()){

			$questionType = Input::get('questionTypeRadio');

			if($questionType == 'written'){

				$question = new Question;
				$question->type = $questionType;
				$question->body = Input::get('questionBody');
				$question->surveys_id = Input::get('surveyIdH');
				$question->save();

				return Redirect::back()->withSuccess('Question added successfully !');

			}else if($questionType == 'mcq'){

				$question = new Question;
				$question->type = $questionType;
				$question->body = Input::get('questionBody');
				$question->surveys_id = Input::get('surveyIdH');
				$question->save();
				
				$choices = Input::get('choices');
				// $i='0';
				foreach ($choices as $child) {
					$choice = new Choice;
					$choice->choice = $child;
					$choice->questions_id = $question->id;
					$choice->save();
				}
				

				// $question->save();

				return Redirect::back()->withSuccess('Question added successfully !');


			}else{
				
				return Redirect::back()->withError('Question Can\'t be created !');

			}

		}

		return Redirect::back()
		   ->withError('Validation Errors Occured !')
		   ->withErrors($validator)
		   ->withInput();

	}

}