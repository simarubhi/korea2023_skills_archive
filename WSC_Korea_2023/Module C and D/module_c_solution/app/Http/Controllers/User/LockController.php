<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LockController extends Controller
{
    public function store(User $user, Request $request)
    {
        $request->validate([
            'reason' => 'required|in:spamming,cheating,other',
        ]);

        $user->delete_reason = $request->get('reason');
        $user->save();
        $user->delete();

        return redirect()->back();
    }
}
