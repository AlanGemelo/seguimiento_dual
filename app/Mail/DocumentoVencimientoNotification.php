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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreAlumno, $fechaVencimiento, $enlaceSistema)
    {
        $this->nombreAlumno = $nombreAlumno;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->enlaceSistema = $enlaceSistema;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.documento_vencimiento')
                    ->subject('Notificación de Vencimiento de Documentos')
                    ->with([
                        'nombreAlumno' => $this->nombreAlumno,
                        'fechaVencimiento' => $this->fechaVencimiento,
                        'enlaceSistema' => $this->enlaceSistema,
                    ]);
    }
}
