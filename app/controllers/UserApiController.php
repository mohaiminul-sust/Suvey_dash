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

    public function changePassword(){
        $user = $this->apiKey->guestUser;
        // return $user;

        $credentials = [
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
        ];

        $validator = Validator::make($credentials, GuestUser::$api_chpass_rules);

        if($validator->fails()){

            return $this->response->errorWrongArgsValidator($validator);
        
        }

        if(!Input::has('password_old')){

            return $this->response->errorUnauthorized("Insert old password"); 

        }

        if(!Hash::check(Input::get('password_old'), $user->password)){

            return $this->response->errorUnauthorized("Your old password is incorrect");
        }

        try {

            $user->password = Hash::make($credentials['password']);
            $user->save();

            return Response::json([
                'success' => [
                    'message' => 'User password changed successfully!',
                    'status_code' => 200,
                    'password_new' => $credentials['password']
                ]
            ], 200);

        } catch (Exception $e) {
            
            return $this->response->errorInternalError('Password can\'t be saved');
        
        }

    }

    public function deauthenticate() {

        if (empty($this->apiKey)) {
            return $this->response->errorUnauthorized("There is no such user to deauthenticate.");
        }

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

        return $this->response->errorNotFound();
        
    }
}