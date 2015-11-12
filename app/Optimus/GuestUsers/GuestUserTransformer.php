<?php namespace Optimus\GuestUsers;

use League\Fractal\TransformerAbstract;

class GuestUserTransformer extends TransformerAbstract {

    public function transform(\GuestUser $user){

        return [
            'index'          => (int) $user->id,
            'email' 		 => (string)$user->email,
            'survey taken'   => (int)$user->getSurveyTakenCount($user->id),
            'creation date'  => $user->created_at,
            'update date'    => $user->updated_at
        ];
    }
}