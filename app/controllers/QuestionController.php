<?php 

class QuestionController extends BaseController{


	public function create(){

		// dd(Input::all());
		if (Input::get('questionBody') == '') {
	
			return Redirect::back()->withError('Input question correctly !');
			
		}
		$validator = Validator::make(Input::all(), Question::$addQuestionRules);

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


				$choices = Input::get('choices');

				if(in_array('', $choices)){
					
					return Redirect::back()->withError('Input options correctly for MCQ !');

				}else{
					$question = new Question;
					$question->type = $questionType;
					$question->body = Input::get('questionBody');
					$question->surveys_id = Input::get('surveyIdH');
					$question->save();

					// $i='0';
					if($choices){
						foreach ($choices as $child) {
							$choice = new Choice;
							$choice->choice = $child;
							$choice->questions_id = $question->id;
							$choice->save();
						}
					}

					// $question->save();

					return Redirect::back()->withSuccess('Question added successfully !');
				}


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