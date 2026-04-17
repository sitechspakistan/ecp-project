<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use App\Models\UserLog;

class LogSuccessfulLogin
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
    public function handle(Login $event)
    {
        UserLog::create([
            'user_id' => $event->user->id,
            'action' => 'login',
            'description' => 'User logged in',
            'user_ip'=>request()->ip()
        ]);
    }
}
