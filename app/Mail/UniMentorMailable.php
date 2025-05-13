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
    public $fromName;
    public $fromEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empresa, $fechaVencimiento, $academico, $enlaceRenovacion,$fromEmail,$fromName)
    {
        $this->empresa = $empresa;
        $this->academico = $academico;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->enlaceRenovacion = $enlaceRenovacion;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
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
               // Verificar si se pasó un correo de remitente personalizado
    if ($this->fromEmail && $this->fromName) {
        // Si se pasaron, se usan como remitente
        $mail->from($this->fromEmail, $this->fromName);
    }

    // Devolver el correo construido
    return $mail;
    }
}
