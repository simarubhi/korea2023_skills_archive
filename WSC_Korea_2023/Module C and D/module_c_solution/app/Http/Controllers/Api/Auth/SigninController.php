<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SigninController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->get('username'))->withTrashed()->first();

        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Wrong username or password',
            ], 401);
        }

        if ($user->trashed()) {
            return [
                'status' => 'blocked',
                'message' => 'User blocked',
                'reason' => User::$DELETE_REASONS[$user->delete_reason] ?? null,
            ];
        }

        return [
            'status' => 'success',
            'token' => $user->createToken('api')->plainTextToken,
        ];
    }
}
