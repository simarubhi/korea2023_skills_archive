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
            'username' => 'required|unique:users|min:4|max:60',
            'password' => 'min:8|max:' . pow(2, 6),
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'token' => $this->createUserToken($user),
        ]);
    }

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|unique:users|min:4|max:60',
            'password' => 'min:8|max:' . pow(2, 6),
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return response()->json([
                'status' => 'success',
                'token' => $this->createUserToken($user),
            ]);
        }
        
        return response()->json([
            'status' => 'invalid',
            'message' => 'Wrong username or password'
        ]);
    }

    public function signout()
    {

    }

    public function createUserToken(User $user)
    {
        $token = $user->createToken('auth-token')->plainTextToken;

        return $token;
    }
}
