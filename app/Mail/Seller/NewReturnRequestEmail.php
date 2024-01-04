<?php

namespace App\Mail\Seller;

use App\Models\OrderItem;
use App\Models\ReturnItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewReturnRequestEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected ?string $sellerName, protected ?string $userName, protected ?string $orderTrackingNo, protected ?string $cancellationReason, protected OrderItem $orderItem, protected ReturnItem $returnItem)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Return Request',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.seller.new-return-request',
            with: [
                'sellerName' => $this->sellerName,
                'userName' => $this->userName,
                'orderNo' => $this->orderTrackingNo,
                'reason' => $this->cancellationReason,
                'item' => $this->orderItem,
                'returnItem' => $this->returnItem,
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
