<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo1_1 extends Model
{
    use HasFactory;

    protected $table = 'anexo_1_1';
    protected $casts = [
        'competencias' => 'array', // Esto convierte automáticamente el JSON a array y viceversa
        'institucion_educativa' => 'string',
        'programa_educativo_id' => 'integer',
        'fecha_elaboracion' => 'datetime',
        'responsable_programa_id' => 'integer',
        'responsable_academico_id' => 'integer'
    ];
    protected $fillable = [
        'institucion_educativa',
        'programa_educativo_id',
        'fecha_elaboracion',
        'responsable_programa_id',
        'responsable_academico_id',
        'competencias'
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'programa_educativo_id');
    }

    public function responsablePrograma()
    {
        return $this->belongsTo(User::class, 'responsable_programa_id');
    }

    public function responsableAcademico()
    {
        return $this->belongsTo(Director::class, 'responsable_academico_id');
    }

    public function setCompetenciasAttribute($value)
    {
        $this->attributes['competencias'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getCompetenciasAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getNombreUsuarioElaboro()
    {
        return $this->responsablePrograma->name;
    }
}
