<?php

namespace App\Listeners;

use App\Events\ClackerCreated;
use App\Models\User;
use App\Notifications\NewClacker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendClackerCreatedNotificatins implements ShouldQueue
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
    public function handle(ClackerCreated $event): void
    {
        foreach (User::whereNot('id', $event->clacker->user_id)->cursor() as $user) {
            $user->notify(new NewClacker($event->clacker));
        }
    }
}
