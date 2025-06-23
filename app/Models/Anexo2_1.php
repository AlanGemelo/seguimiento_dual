<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo2_1 extends Model
{
    use HasFactory;
    protected $table = 'anexo2_1';

    protected $fillable = [
        'unidad_economica',
        'periodo',
        'fecha',
        'seccion_1',
        'seccion_2',
        'seccion_3',
        'aplicador',
        'autorizo',
        'nivel_vulnerabilidad',
        'resultado_definitivo',
    ];

    protected $casts = [
        'seccion_1' => 'array',
        'seccion_2' => 'array',
        'seccion_3' => 'array',
    ];

    public function autorizoUser()
    {
        return $this->belongsTo(User::class, 'autorizo');
    }
}
