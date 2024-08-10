<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UnlockController extends Controller
{
    public function store(User $user)
    {
        $user->restore();
        $user->delete_reason = null;
        $user->save();

        return redirect()->back();
    }
}
