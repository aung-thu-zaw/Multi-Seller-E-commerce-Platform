<?php

namespace App\Mail\User;

use App\Models\SellerRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerRequestStatusEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected string $userName, protected SellerRequest $sellerRequest)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@support.ecommerce.com', 'E-commerce Platform'),
            subject: 'Seller Request Status',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.user.seller-request-status',
            with: [
                'name' => $this->userName,
                'store_name' => $this->sellerRequest->store_name,
                'store_type' => $this->sellerRequest->store_type,
                'contact_phone' => $this->sellerRequest->contact_phone,
                'contact_email' => $this->sellerRequest->contact_email,
                'address' => $this->sellerRequest->address,
                'additional_information' => $this->sellerRequest->additional_information,
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
