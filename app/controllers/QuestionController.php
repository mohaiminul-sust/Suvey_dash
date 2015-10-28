<?php 

class QuestionController extends BaseController{


	public function create(){

		// dd(Input::all());
		if (Input::get('questionBody') == '' || strlen(Input::get('questionBody')) == 0) {
	
			return Redirect::back()->withError('Input question correctly !')->withInput();
			
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

				
				for ($i=0; $i <= (int) Input::get('count'); $i++) { 
					$choices[$i] = Input::get('choice'.$i);	
				}

				if(in_array('', $choices)){
					
					return Redirect::back()->withError('Input options correctly for MCQ ! No Blank Options Allowed !')->withInput();

				}else if(count($choices)==1){
					
					return Redirect::back()->withError('Input options correctly for MCQ ! Only one option NOT Allowed !')->withInput();

				}else{

					$question = new Question;
					$question->type = $questionType;
					$question->body = Input::get('questionBody');
					$question->surveys_id = Input::get('surveyIdH');
					$question->save();

					if($choices){

						foreach ($choices as $child) {

							$choice = new Choice;
							$choice->choice = $child;
							$choice->questions_id = $question->id;
							$choice->save();

						}

					}

					return Redirect::back()->withSuccess('Question added successfully !');
				}


			}else{
				
				return Redirect::back()->withError('Question Can\'t be created !')->withInput();

			}

		}

		return Redirect::back()
		   ->withError('Validation Errors Occured !')
		   ->withErrors($validator)
		   ->withInput();

	}


	public function update(){

		// dd(Input::all());
		if (Input::get('questionBody') == '' || strlen(Input::get('questionBody')) == 0) {
	
			return Redirect::back()->withError('Input question correctly !');
			
		}

		$validator = Validator::make(Input::all(), Question::$addQuestionRules);

		if($validator->passes()){
		
			$question = Question::find(Input::get('questionId'));

			$questionType = $question->type;

			if($questionType == 'written'){

				$question->body = Input::get('questionBody');
				$question->save();

				return Redirect::back()->withSuccess('Question added successfully !');

			}else if($questionType == 'mcq'){

				
				for ($i=0; $i <= (int) Input::get('count-upd'); $i++) { 
					$choices[$i] = Input::get('choice'.$i);	
				}

				if(in_array('', $choices)){
					
					return Redirect::back()->withError('Input options correctly for MCQ ! No Blank Options Allowed !');

				}else if(count($choices)==1){
					
					return Redirect::back()->withError('Input options correctly for MCQ ! Only one option NOT Allowed !');

				}else{

					$question->body = Input::get('questionBody');
					$question->save();

					foreach($question->choices as $oldChoice){
						$oldChoice->delete();
					}

					if($choices){

						foreach ($choices as $child) {

							$choice = new Choice;
							$choice->choice = $child;
							$choice->questions_id = $question->id;
							$choice->save();

						}

					}

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


	public function destroy(){
		// dd(Input::all());
		$question = Question::find(Input::get('questionId'));

		if($question){
			$question->delete();

			return Redirect::back()->withSuccess('Question Deleted !');
		}

		return Redirect::back()->withError('Question Deletetion failed !');

	}

}