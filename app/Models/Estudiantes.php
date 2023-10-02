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
    ];
}
