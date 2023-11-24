<?php

namespace App\Notifications\Blogs;

use App\Models\BlogComment;
use App\Models\BlogContent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewBlogCommentFromUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected BlogContent $blogContent, protected BlogComment $blogComment, protected User $user)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array<string>
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'blog' => $this->blogContent->slug,
            'comment' => $this->blogComment->comment,
            'user' => $this->user->only('avatar', 'name'),
        ];
    }
}
