<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\ToJson;

class AuthController extends Controller
{
    /**
     * @param Request $request
     */
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

         ToJson::json($accessToken,'ok','201','User was created');

    }

    public function login(Request $request){

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required|confirmed',
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message' => 'Invalid credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }
}
