<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo1_2 extends Model
{
    use HasFactory;
    protected $table = 'anexo_1_2';

    protected $fillable = [
        'fecha_elaboracion',
        'quien_elaboro_id',
        'nombre_firma_ie',
        'actividades',
        'responsable_programa_id',
        'responsable_academico_id',
    ];

    protected $casts = [
        'actividades' => 'array'
    ];

    public function quienElaboro()
    {
        return $this->belongsTo(Director::class, 'quien_elaboro_id'); // Relación con la tabla directors
    }

    public function responsablePrograma()
    {
        return $this->belongsTo(Director::class, 'responsable_programa_id');
    }

    public function responsableAcademico()
    {
        return $this->belongsTo(User::class, 'responsable_academico_id');
    }

    public function getNombreQuienElaboro()
    {
        return $this->quienElaboro->name;
    }

    // En el modelo Anexo1_2.php
    public function getActividadesAttribute($value)
    {
        return json_decode($value, true) ?: [];
    }
    public function getActividadesArrayAttribute()
    {
        return is_array($this->actividades) ? $this->actividades : json_decode($this->actividades, true);
    }
}
