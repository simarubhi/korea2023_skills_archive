<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function block(Request $request, $id)
    {
        $user = User::find($id);

        $block_reason = 'You have been blocked by an administrator';

        if ($request->reason == 'spam') {
            $block_reason = 'You have been blocked for spamming';
        } else if ($request->reason == 'cheating') {
            $block_reason = 'You have been blocked for cheating';
        }

        $user->block_reason = $block_reason;
        $user->save();

        $user->delete();

        return back();
    }

    public function unblock(Request $request, $id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();

        $user->block_reason = null;
        $user->save();

        return back();
    }
}
