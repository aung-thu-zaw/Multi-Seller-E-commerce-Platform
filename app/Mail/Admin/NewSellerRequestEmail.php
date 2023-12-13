<?php

namespace App\Mail\Admin;

use App\Models\SellerRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewSellerRequestEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected User $user,protected SellerRequest $sellerRequest)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Seller Request',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.admin.new-seller-request',
            with: [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
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
