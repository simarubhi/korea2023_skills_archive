<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
}
