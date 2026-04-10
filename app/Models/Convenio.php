<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'tipo',
        'inicio',
        'fin',
        'vigencia',
        'archivo',
        'version',
    ];

    // Relación con empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
