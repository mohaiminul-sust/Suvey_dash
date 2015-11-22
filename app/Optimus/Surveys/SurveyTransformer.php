<?php namespace Optimus\Surveys;

use League\Fractal\TransformerAbstract;
use Optimus\Questions\QuestionTransformer;


class SurveyTransformer extends TransformerAbstract {

	protected $availableIncludes = [
        'questions'
    ];

    public function transform(\Survey $survey) {
    	
        return [
        
            'index'             => (int) $survey->id,
            'title' 	        => (string)$survey->title,
            'creator'           => (string)$survey->user->username,
            'taken'             => (bool)$survey->is_taken,
            'taken by'          => (int)count($survey->taken_by),
            'mcq count'         => (int)$survey->mcq_count,
            'written count'     => (int)$survey->wr_count,
            'creation date'     => $survey->getSurveyCreatedDate(),
            'links'             =>  [
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