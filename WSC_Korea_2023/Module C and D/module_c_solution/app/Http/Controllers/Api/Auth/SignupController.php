<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:4|max:60|unique:users',
            'password' => 'required|min:8|max:65536'
        ]);

        $user = new User();
        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return response()->json([
            'status' => 'success',
            'token' => $user->createToken('api')->plainTextToken,
        ], 201);
    }
}
