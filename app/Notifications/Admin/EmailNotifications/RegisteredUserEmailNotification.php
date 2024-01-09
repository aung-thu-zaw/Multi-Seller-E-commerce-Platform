<?php

namespace App\Notifications\Admin\EmailNotifications;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredUserEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected User $user)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('New User Registered')
            ->greeting('Dear '.$notifiable->name.',')
            ->line('A new user has registered on our platform. Please review the details below:')
            ->line('Name: '.$this->user->name)
            ->line('Email: '.$this->user->email)
            ->line('Registration Date: '.Carbon::parse($this->user->created_at)->format('Y-m-d'));
    }
}
