<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    

public function signup(Request $request)
{
    $validated_data = $request->validate([
        "username" => "required|string|unique:users,username",
        "email" => "required|email|unique:users,email",
        "password" => "required|string|min:7|confirmed",
        "phone_number" => "required|numeric",
        "country_code"=>"required|string",
        "profile_url"=>"nullable|string"
    ]);

    $user = User::create([
        'username' => $validated_data['username'],
        'email' => $validated_data['email']??null,
        'password' => bcrypt($validated_data['password']),
        'phone_number' => $validated_data['phone_number'],
        'profile_url' => $validated_data['profile_url']?? null,
        'country_code' => $validated_data['country_code'],


    ]);

    return response()->json([
        "message"=>"user created successfully",
        "user"=> $user
        ]
    
    );
}



public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string'
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'message' => "user logged in successfully",
        'token' => $token
    ]);
}

public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Successfully logged out']);
}


}
