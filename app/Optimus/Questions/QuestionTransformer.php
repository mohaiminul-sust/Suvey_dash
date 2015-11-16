<?php namespace Optimus\Questions;

use League\Fractal\TransformerAbstract;
use Optimus\Choices\ChoiceTransformer;

class QuestionTransformer extends TransformerAbstract {


    public function transform(\Question $question){
        
        return [
            'index'     	=> (int) $question->id,
            'type' 			=> (string)$question->type,
            'body'      	=> (string)$question->body,
            'creation date' => $question->created_at,
            'update date'   => $question->updated_at,
            'choices' 		=> $question->getChoices(),
        ];
    }


}