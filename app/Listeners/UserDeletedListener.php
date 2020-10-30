<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use App\Notifications\UserDeletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserDeletedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserDeleted $event)
    {
        $event->user->notify(new UserDeletedNotification($event->user));
    }
}
