<?php

namespace App\Listeners\Registered;

use App\Models\User;
use App\Notifications\Admin\EmailNotifications\RegisteredUserEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserRegisteredEmailNotificationToAdmin implements ShouldQueue
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

        $admins = User::where("role", "admin")->get();

        Notification::send($admins, new RegisteredUserEmailNotification($user));
    }
}
