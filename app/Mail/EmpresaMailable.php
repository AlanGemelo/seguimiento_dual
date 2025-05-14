<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmpresaMailable extends Mailable
{

    use Queueable, SerializesModels;

    public $nombreSujeto;
    public $fechaVencimiento;
    public $asesorIn;
    public $destinatario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreSujeto, $fechaVencimiento,$asesorIn)
    {
        $this->nombreSujeto = $nombreSujeto;
        $this->asesorIn = $asesorIn;
        $this->fechaVencimiento = $fechaVencimiento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.empresa_vencimiento')
            ->subject('Notificación de Vencimiento de Convenio con la Universidad Tecnologica del Valle de Toluca')
            ->with([
                'nombreSujeto' => $this->nombreSujeto,
                'asesorIn' => $this->asesorIn,
                'fechaVencimiento' => $this->fechaVencimiento,
            ]);
    }
}
