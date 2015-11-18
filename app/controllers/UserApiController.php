<?php 

use Chrisbjr\ApiGuard\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Chrisbjr\ApiGuard\Transformers\ApiKeyTransformer;
use Optimus\GuestUsers\GuestUserTransformer;

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
		],

        'create' => [
            'keyAuthentication' => false
        ]
	];

    public function create(){

        $user_cred = Input::all();

        $validator = Validator::make( $user_cred, GuestUser::$rules);

        if($validator->passes()){
            $user = new GuestUser;

            $passcode = Input::get('password');
            $user->email = Input::get('email');
            $user->password = Hash::make($passcode);
            $user->save();

            $guest = GuestUser::find($user->id);

            if($guest){
                
                return Response::json([
                    'success' => [
                        'message' => 'Account Created Successfully !',
                        'status_code' => 201,
                        'userinfo' => Fractal::item($guest, new GuestUserTransformer)
                    ]
                ], 201);    
                
            }

            return Response::json([
                    'error' => [
                        'message' => 'Account Creation Error !',
                        'status_code' => 500    
                    ]
            ], 500);



        }

        return $this->response->errorWrongArgsValidator($validator);

    }

	public function authenticate(){

		$credentials = [
			'email' => Input::get('email'),
			'password' => Input::get('password')
		];


        try {
            $user = GuestUser::where('email', $credentials['email'])->first();
            // $credentials['email'] = $user->email;
        } catch (\ErrorException $e) {
            return $this->response->errorUnauthorized("Your email is incorrect");
        }

        if(!Hash::check($credentials['password'], $user->password)){

            return $this->response->errorUnauthorized("Your password is incorrect"); 
        
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
        $user = $this->apiKey->guestUser;


        if($user){
            // return $user;
            return Fractal::item($user, new GuestUserTransformer);
        } 

        return $this->response->errorNotFound();
    
    }

    public function deauthenticate() {

        if (empty($this->apiKey)) {
            return $this->response->errorUnauthorized("There is no such user to deauthenticate.");
        }


        // return $this->apiKey->guestUser;
        $key = ApiKey::find($this->apiKey->id);

        if($key){
            
            ApiKey::destroy($this->apiKey->id);

            return Response::json([
                'success' => [
                    'message' => 'User deauthenticated Successfully !',
                    'status_code' => 200
                ]
            ], 200);
        }

        return Response::json([
            'error' => [
                'message' => 'User not found !',
                'status_code' => 404
            ]
        ], 404);
        
    }
}