<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo1_3 extends Model
{
    use HasFactory;
    protected $table = 'anexo_1_3';


    protected $fillable = [
        'fecha_realizacion',
        'lugar',
        'razon_social',
        'rfc',
        'domicilio',
        'nombre_representante',
        'cargo_representante',
        'telefono',
        'correo_electronico',
        'actividad_economica',
        'numero_empleados',
        'participacion_anterior',
        'motivo_no_participacion',
        'interes_participar',
        'numero_estudiantes',
        'motivo_no_interes',
        'informacion_clara',
        'comentarios_adicionales',
        'quien_elaboro_id'
    ];

    protected $casts = [
        'motivo_no_participacion' => 'array',
        'motivo_no_interes' => 'array',
        'comentarios_adicionales' => 'array'
    ];
}
