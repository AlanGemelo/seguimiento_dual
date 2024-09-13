<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion_id',
        'email',
        'telefono',
    ];
    public function direccion()
    {
        return $this->belongsTo(DireccionCarrera::class, 'direccion_id', 'id');
    }
}
