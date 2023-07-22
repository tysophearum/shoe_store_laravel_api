<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate(([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|confirmed"
        ]));

        $user = User::create([
            "name" => $fields['name'],
            "email" => $fields['email'],
            "password" => bcrypt($fields['password']),
            "role" => $request->all()['role']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
        // return $request->all();
    }
    public function logout(Request $request) {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });

        return [
            "message" => "Logged out"
        ];
    }
    public function login (Request $request){
        $fields = $request->validate(([
            "email" => "required|string",
            "password" => "required|string"
        ]));
        
        //Check user email
        $user = User::where('email', $fields['email'])->first();

        //Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => "Bad creds"
            ], 401);
        }

        // $checkToken = PersonalAccessToken::where('tokenable_id', $user->id)->first();

        // if($checkToken) {
        //     return response($checkToken->token, 201);
        // }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function user(Request $request) {
        return $request->user;
    }
}
