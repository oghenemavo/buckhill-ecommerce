<?php

namespace App\Listeners;

use App\Events\LoginUser;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserLastLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginUser  $event
     * @return void
     */
    public function handle(LoginUser $event)
    {
        $user = $event->user;
        $user->last_login_at = Carbon::now()->toISOString();
        $user->save();
    }
}
