<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrera extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'grado_academico',
        'nombre',
        'direccion_id',
        'email',
        'telefono',
    ];

    public function direccion()
    {
        return $this->belongsTo(DireccionCarrera::class, 'direccion_id', 'id');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiantes::class, 'carrera_id', 'id');
    }
}
