<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $email;
    public $contrasenaSugerida;

    public function __construct($nombre, $email, $contrasenaSugerida)
    {
        // Asigna las variables pasadas al constructor
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contrasenaSugerida = $contrasenaSugerida;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registro Exitoso - Credenciales',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mails.post-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
