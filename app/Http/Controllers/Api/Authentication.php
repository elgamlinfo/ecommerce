<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
class Authentication extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->apiResponse(null ,$validator->messages() , 200);

        }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return $this->apiResponse($user);

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->apiResponse(null , $validator->messages() , 200);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->apiResponse(null ,'Login credentials are invalid.' , 200);
            }
        } catch (JWTException $e) {
            return $this->apiResponse(null ,'Could not create token.' , 200);
    	    // return $credentials;
            // return response()->json([
            //     	'success' => false,
            //     	'message' => 'Could not create token.',
            //     ], 500);
        }

 		//Token created, return with success response and jwt token
         $data = [
             'user' => auth()->user(),
             'token' => $token

         ];
         return $this->apiResponse($data);

    }
    public function logout(Request $request)
    {
		//Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);
            return $this->apiResponse(null , null , 200);
        } catch (JWTException $exception) {
            return $this->apiResponse(null ,'Sorry, user cannot be logged out' , 200);

        }
    }

    // public function get_user()
    // {
    //     $user = auth()->user();
    //     return response()->json(['user' => $user]);
    // }
}
