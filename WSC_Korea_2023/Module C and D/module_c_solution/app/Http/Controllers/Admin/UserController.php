<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users', ['users' => Administrator::all()]);
    }
}
