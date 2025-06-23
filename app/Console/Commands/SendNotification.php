<?php

namespace App\Console\Commands;

use App\Jobs\EnviarRecordatoriosJob;
use App\Mail\DocumentoVencimientoNotification;
use App\Mail\EmpresaMailable;
use App\Mail\UniMentorMailable;
use App\Models\Empresa;
use App\Models\Estudiantes;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendNotification extends Command
{
    /**
     * El nombre y la firma del comando de consola.
     *
     * @var string
     */
    protected $signature = 'job:email';

    /**
     * La descripción del comando de consola.
     *
     * @var string
     */
    protected $description = 'Envía correos electrónicos cuando se acerca la fecha de vencimiento de la documentación entregada';

    /**
     * Ejecuta el comando de consola.
     *
     * @return int
     */
    public function handle()
    {
        $hoy = Carbon::now();
        Log::info('Envio de correos a las: ' . $hoy.'Desde Local');
        // Buscar registros en las tablas que coincidan con la fecha de 15 días antes
        $registros = Estudiantes::with('academico','asesorin')->whereDate('fin_dual','<=', $hoy->addDays(15))->where('activo',true)->get();
        $registrosConvenio = Empresa::with('asesorin')->whereDate('fin_conv','<=', $hoy->addDays(15))->get();
        // Enviar correos por cada registro
        foreach ($registrosConvenio as $registro) {
            // Mail::to('al222010229@utvtol.edu.mx')->send(new UniMentorMailable($registro, $registro->fin_conv,$registro->asesorin,env('APP_URL')));
            Mail::to('alanortega.dp@gmail.com')->send(new UniMentorMailable($registro, $registro->fin_conv,$registro->asesorin, env('APP_URL'),session('direccion')->email,session('direccion')->name));
            Log::info('Correo enviado a: ' . $registro->email . 'Alumno: ' . $registro->name);
            Mail::to($registro->email)->send(new EmpresaMailable($registro->nombre, $registro->fin_conv,$registro->asesorin));
        }
        foreach ($registros as $registro) {
            Mail::to($registro->academico->email)->send(new DocumentoVencimientoNotification($registro->name,$registro->academico->nombre, $registro->fin_dual, env('APP_URL')));
            Log::info('Correo enviado a: ' . $registro->academico->email . 'Alumno: ' . $registro->name);
        }
    }
}
