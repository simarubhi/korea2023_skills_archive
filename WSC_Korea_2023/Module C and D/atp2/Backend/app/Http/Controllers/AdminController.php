<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
 
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect()->route('admin-login-view');
    }

    public function user(Request $request, $username)
    {
        $user = User::where('username', $username)->first();

        if ($user->blocked) {
            return redirect(404);
        }

        return view('user', ['user' => $user]);
    }


    public function user_block(Request $request, $id)
    {
        $user = User::findorFail($id);

        $user->blocked = true;

        if ($request->reason == 'admin') {
            $user->reason = 'You have been blocked by an administrator';
        } else if ($request->reason == 'spam') {
            $user->reason = 'You have been blocked for spamming';
        } else if ($request->reason == 'cheat') {
            $user->reason = 'You have been blocked for cheating';
        } else {
            $user->reason = 'You have been blocked by an administrator';
        }

        $user->save();

        return redirect()->back();
    }
    
    public function user_unblock(Request $request, $id)
    {
        $user = User::findorFail($id);
        
        $user->blocked = false;
        $user->reason = null;
        $user->save();

        return redirect()->back();
    }
}
