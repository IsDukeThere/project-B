<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusSetoranMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $deposit)
    {
    }

    public function envelope(): Envelope
    {
        $statusLabel = match ($this->deposit->status) {
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            default => 'Diperbarui',
        };

        return new Envelope(
            subject: "Setoran Sampah Anda {$statusLabel} - Project B Indonesia",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.status-setoran',
        );
    }
}