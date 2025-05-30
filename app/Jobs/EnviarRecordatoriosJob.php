<?php

namespace App\Jobs;

use App\Mail\DocumentoVencimientoNotification;
use App\Mail\EmpresaMailable;
use App\Mail\RecordatorioMailable;
use App\Mail\UniMentorMailable;
use App\Models\Empresa;
use App\Models\Estudiantes;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EnviarRecordatoriosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle()
    {
    //     $hoy = Carbon::now();
    //     Log::info('Job ejecutado a las: ' . $hoy);
    //     // Buscar registros en las tablas que coincidan con la fecha de 15 días antes
    //     $registros = Estudiantes::with('academico','asesorin')->whereDate('fin_dual','<=', $hoy->addDays(15))->where('activo',true)->get();
    //     $registrosConvenio = Empresa::with('asesorin')->whereDate('fin_conv','<=', $hoy->addDays(15))->get();
    //     // Enviar correos por cada registro
    //     foreach ($registrosConvenio as $registro) {
    //         Storage::append("Regostro . $registro->nombre", Carbon::now());
    //     Mail::to('al222010229@utvtol.edu.mx')->send(new UniMentorMailable($registro, $registro->fin_conv,$registro->asesorin,env('APP_URL')));
    //     Mail::to($registro->email)->send(new EmpresaMailable($registro->nombre, $registro->fin_conv,$registro->asesorin));
    // }
    //     foreach ($registros as $registro) {
    //         Mail::to($registro->academico->email)->send(new DocumentoVencimientoNotification($registro->name,$registro->academico->nombre, $registro->fin_dual, env('APP_URL')));
    //         };
    //         Log::info('Registros encontrados: ' . $registros->count());
        }

}
