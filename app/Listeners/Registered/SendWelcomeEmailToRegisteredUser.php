<?php

namespace App\Listeners\Registered;

use App\Mail\User\RegisteredUserWelcomeEmail;
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
