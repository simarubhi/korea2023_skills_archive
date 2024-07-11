<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LastLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;

        if ($user instanceof Admin) {
            $user->last_login = now();
            $user->save();
        } else if ($user instanceof User) {
            $user->last_login = now();
            $user->save();
        }
    }
}
