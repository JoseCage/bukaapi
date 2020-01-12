<?php

namespace Buka\Http\Controllers\Api\Auth;

use App\Services\WeSenderService;
use Illuminate\Http\Request;
use Buka\Http\Controllers\Controller;
use Buka\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    /**
       * Authenticate the user
       *
       * @param  Request $request
       * @return \Illuminate\Http\JsonResponse
       */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'invalid_credentials'
                ], 401);
            }
        } catch (JWTException $ex) {
            // something went wrong
            return response()->json([
                'error' => 'could_not_create_token',
            ], 500);
        }

        // if we don't have problems, generate token
        return response()->json(
            [
            'access_token' => $token,
            'token_type' => 'Bearer'
            ], 200
        );
    }

    /**
     * Register a new User
     *
     * @param  RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    $validator->errors(),
                ],
            ], 401);
        }

        $data = $request->only('email', 'password');

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                //'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);

            // Generate the token
            $token = JWTAuth::attempt($data);

            // Send a SMS to the teacher
        //WeSenderService::send($user->phone, 'Parabéns, ' . $user->name . ' por se cadastrar como professor no Buka App');

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'could_not_create_token'
            ],500);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);

    }
}
