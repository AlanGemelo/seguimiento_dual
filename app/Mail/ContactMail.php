<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nombre;
    public $correo;
    public $mensaje;
    public $asunto;
    public $archivo;
    public function __construct($nombre, $correo, $mensaje, $asunto, $archivo) 
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->mensaje = $mensaje;
        $this->asunto = $asunto;
        $this->archivo = $archivo;

        
  
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Documentacion por Vencer',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.layout',
            with: ['nombre' => $this->nombre, 'correo' => $this->correo, 'mensaje' => $this->mensaje, 'asunto' => $this->asunto, 'archivo' => $this->archivo],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
