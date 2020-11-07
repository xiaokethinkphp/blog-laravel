<?php

namespace App\Listeners;

use App\Events\CategoryDeleted;
use App\Notifications\UserDeletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CategoryDeletedListener
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
    public function handle(CategoryDeleted $event)
    {
        $event->category->articles()->delete();
    }
}
