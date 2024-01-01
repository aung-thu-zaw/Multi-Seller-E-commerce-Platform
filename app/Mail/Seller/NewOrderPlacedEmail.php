<?php

namespace App\Mail\Seller;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderPlacedEmail extends Mailable
{
    use Queueable;
    use SerializesModels;


    /**
    * @param array<OrderItem> $orderItems
    */
    public function __construct(protected Store $store, protected Address $address, protected array $orderItems)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order Placed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.seller.new-order-placed',
            with: [
                'seller' => $this->store->seller->name,
                'address' => $this->address,
                'orderItems' => $this->orderItems,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
