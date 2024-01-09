<?php

namespace App\Notifications\Seller;

use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewProductQuestionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Product $product, protected ProductQuestion $productQuestion, protected User $user)
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
            'product' => $this->product->slug,
            'question' => $this->productQuestion->question,
            'user' => $this->user->only('avatar', 'name'),
        ];
    }
}
