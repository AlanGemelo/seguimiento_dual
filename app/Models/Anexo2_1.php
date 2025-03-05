<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo2_1 extends Model
{
    use HasFactory;
    protected $table = 'anexo_2_1';

    protected $fillable = [
        'unidad_economica',
        'periodo',
        'fecha',
        'seccion_1',
        'seccion_2',
        'seccion_3'
    ];

    protected $casts = [
        'seccion_1' => 'array',
        'seccion_2' => 'array',
        'seccion_3' => 'array'
    ];
}
