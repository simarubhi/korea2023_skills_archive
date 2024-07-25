<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|max:60|unique:users,username',
            'password' => 'required|min:8|max:' . pow(2, 16),
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->username.now())->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
        ], 201);
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|max:60',
            'password' => 'required|min:8|max:' . pow(2, 16),
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Wrong username or password',
            ], 401);
        }
        
        $token = $user->createToken($user->username.now())->plainTextToken;
            
        return response()->json([
            'status' => 'success',
            'token' => $token,
        ], 200);
    }
}
