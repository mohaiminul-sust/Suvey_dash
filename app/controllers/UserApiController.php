<?php 

use Chrisbjr\ApiGuard\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Chrisbjr\ApiGuard\Transformers\ApiKeyTransformer;

/**
* 
*/
class UserApiController extends ApiGuardController{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }

	protected $apiMethods = [
		'authenticate' => [
			'keyAuthentication' => false
		]
	];


	public function authenticate(){
		// $credentials = Input::all();

		// $credentials['username'] = 'Friedrich';
  //       $credentials['password'] = 'admindev';

		$credentials = [
			'username' => Input::get('username'),
			'password' => Input::get('password')
		];

		$apiuserRules = [
            'username' => 'required|max:255',
            'password' => 'required|max:255'
        ];

        $validator = Validator::make( $credentials, $apiuserRules);

        if ($validator->fails()) {
            return $this->response->errorWrongArgsValidator($validator);
        }

        try {
            $user = User::whereUsername($credentials['username'])->first();
            // $credentials['email'] = $user->email;
        } catch (\ErrorException $e) {
            return $this->response->errorUnauthorized("Your username or password is uncorrect");
        }

        if (Auth::attempt($credentials) == false)
		{

		    return $this->response->errorUnauthorized("Your username or password is incorrect");

		}


		$apiKey = ApiKey::where('user_id', '=', $user->id)->first();

        if (!isset($apiKey)) {
            $apiKey                = new ApiKey;
            $apiKey->user_id       = $user->id;
            $apiKey->key           = $apiKey->generateKey();
            $apiKey->level         = 8;
            $apiKey->ignore_limits = 0;
        } else {
            $apiKey->generateKey();
        }

        if (!$apiKey->save()) {
            return $this->response->errorInternalError("Failed to create an API key. Please try again.");
        }


        return $this->response->withItem($apiKey, new ApiKeyTransformer);

	}


	public function getUserDetails() {
        $user = $this->apiKey->user;

        return isset($user) ? $user : $this->response->errorNotFound();
    }

    public function deauthenticate() {

        if (empty($this->apiKey)) {
            return $this->response->errorUnauthorized("There is no such user to deauthenticate.");
        }

        $this->apiKey->delete();

        return $this->response->withArray([
            'ok' => [
                'code'      => 'SUCCESSFUL',
                'http_code' => 200,
                'message'   => 'User was successfuly deauthenticated'
            ]
        ]);
    }
}