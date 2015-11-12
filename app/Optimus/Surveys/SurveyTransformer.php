<?php namespace Optimus\Surveys;

use League\Fractal\TransformerAbstract;

class SurveyTransformer extends TransformerAbstract {

    public function transform(\Survey $survey) {
    	
        return [
            'index'     => (int) $survey->id,
            'title' 	=> $survey->title,
            'creation date'  => $survey->created_at
        ];
    }
}