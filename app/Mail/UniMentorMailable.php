<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UniMentorMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $empresa;
    public $fechaVencimiento;
    public $academico;
    public $enlaceRenovacion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empresa, $fechaVencimiento, $academico, $enlaceRenovacion)
    {
        $this->empresa = $empresa;
        $this->academico = $academico;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->enlaceRenovacion = $enlaceRenovacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.universidad_empresa')
            ->subject('Notificación de Vencimiento de Convenio con la Empresa ' . $this->empresa->nombre)
            ->with([
                'empresa' => $this->empresa,
                'academico' => $this->academico,
                'enlaceRenovacion' => $this->enlaceRenovacion,
                'fechaVencimiento' => $this->fechaVencimiento,
            ]);
    }
}
