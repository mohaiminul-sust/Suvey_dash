<?php namespace Optimus\SurveyTransformer;

use League\Fractal\TransformerAbstract;

class SurveyTransformer extends TransformerAbstract{

	public function transform(Survey $survey){

		return[
			
			'id' => (int) $survey->id,
			'title' => $survey->title,
			'create_date' => $survey->created_at
		];

	}
}