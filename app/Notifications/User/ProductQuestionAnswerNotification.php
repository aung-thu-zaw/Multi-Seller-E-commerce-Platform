<?php

namespace App\Notifications\User;

use App\Models\Product;
use App\Models\ProductQuestionAnswer;
use App\Models\Store;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductQuestionAnswerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Product $product, protected ProductQuestionAnswer $productQuestionAnswer, protected Store $store)
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
            'answer' => $this->productQuestionAnswer->answer,
            'store' => $this->store->only('avatar', 'store_name'),
        ];
    }
}
