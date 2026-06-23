<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Booking $booking, public string $previousStatus)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Booking Status Update - {$this->booking->reference_number}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.status-update',
        );
    }
}
