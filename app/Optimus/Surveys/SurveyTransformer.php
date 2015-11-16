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
            'title' 	=> $survey->title,
            'creator'   => $survey->user->username,
            'creation date'  => $survey->created_at,
            'links' => [
            	[
            		'rel' => 'self',
            		'uri' => '/surveys/'.$survey->id,
            	]
            ]
        ];
    }

    // public function includeCreator(\Survey $survey){
    // 	$user 
    // }

    public function includeQuestions(\Survey $survey)
    {
        $questions = $survey->questions;

        return $this->collection($questions, new QuestionTransformer);
    }

}