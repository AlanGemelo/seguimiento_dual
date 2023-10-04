<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudiantes extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'matricula';

    protected $fillable = [
        'matricula',
        'name',
        'curp',
        'fecha_na',
        'activo',
        'cuatrimestre',
        'nombre_proyecto',
        'inicio_dual',
        'fin_dual',
        'beca',
        'ine',
        'evaluacion_form',
        'minutas',
        'carta_acp',
        'plan_form',
        'historial_academico',
        'perfil_ingles',
        'empresa_id',
        'academico_id',
        'asesorin_id',
        'carrera_id',
    ];
}
