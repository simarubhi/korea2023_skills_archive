<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
        'message' => 'The admin was not found'
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
       Auth::guard('admin')->logout();
       
       $request->session()->invalidate();

       $request->session()->regenerateToken();

       return redirect('/admin');
    }

    public function unblock_user(Request $request)
    {
        $user = User::find($request->user_id);
        
        $user->blocked = false;
        $user->block_reason = null;

        $user->save();

        return back();
    }

    public function block_user(Request $request)
    {
        $user = User::find($request->user_id);
        
        $user->blocked = true;
        $user->block_reason = $request->block_reason;

        $user->save();

        return back();
    }
}
