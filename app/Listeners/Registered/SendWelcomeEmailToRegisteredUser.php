<?php

namespace App\Listeners\Registered;

use App\Mail\User\RegisteredUserWelcomeEmail;
use App\Notifications\Admin\EmailNotifications\RegisteredUserEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailToRegisteredUser
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
        $user = $event->user ?? null;

        Mail::to($user->email)->queue(new RegisteredUserWelcomeEmail($user));
    }
}
