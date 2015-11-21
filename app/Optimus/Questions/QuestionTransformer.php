<?php namespace Optimus\Questions;

use League\Fractal\TransformerAbstract;
use Optimus\Choices\ChoiceTransformer;

class QuestionTransformer extends TransformerAbstract {


    public function transform(\Question $question){
        
        return [
            'index'     	=> (int) $question->id,
            'type' 			=> (string) $question->type,
            'question'      => (string) $question->body,
            'creation date' => $question->getQuestionCreatedDate(),
            'choices' 		=> $question->getChoices(),
            'links'             =>  [
                                        [
                                            'rel' => 'self',
                                            'uri' => '/questions/'.$question->id,
                                        ]
                                    ]
        ];
    }


}