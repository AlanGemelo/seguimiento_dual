<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentoVencimientoNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreAlumno;
    public $fechaVencimiento;
    public $enlaceSistema;
    public $academico;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreAlumno,$academico, $fechaVencimiento, $enlaceSistema)
    {
        $this->nombreAlumno = $nombreAlumno;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->enlaceSistema = $enlaceSistema;
        $this->academico = $academico;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.documento_vencimiento')
                    ->subject('Notificación de Vencimiento de Convenio')
                    ->with([
                        'nombreAlumno' => $this->nombreAlumno,
                        'fechaVencimiento' => $this->fechaVencimiento,
                        'enlaceSistema' => $this->enlaceSistema,
                        'academico' => $this->academico,
                    ]);
    }
}
