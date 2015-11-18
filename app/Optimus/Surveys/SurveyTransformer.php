<?php namespace Optimus\Surveys;

use League\Fractal\TransformerAbstract;
use Optimus\Questions\QuestionTransformer;


class SurveyTransformer extends TransformerAbstract {

	protected $availableIncludes = [
        'questions'
    ];

    public function transform(\Survey $survey) {
    	
        return [
            'index'     => (int) $survey->id,
            'title' 	=> (string)$survey->title,
            'creator'   => (string)$survey->user->username,
            'taken'     => (bool)$survey->is_taken,
            'creation date'  => $survey->created_at,
            'links'     =>  [
                            	[
                            		'rel' => 'self',
                            		'uri' => '/surveys/'.$survey->id,
                            	]
                            ]
            
        ];
    }

    public function includeQuestions(\Survey $survey)
    {
        $questions = $survey->questions;

        return $this->collection($questions, new QuestionTransformer);
    }

}