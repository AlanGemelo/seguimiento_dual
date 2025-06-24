<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaDireccion extends Model
{
    use HasFactory;
    protected $table = 'empresa_direccion';

    protected $fillable = [
        'empresa_id',
        'direccion_id',
    ];

    // Relación con Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    // Relación con DireccionCarrera
    public function direccionCarrera()
    {
        return $this->belongsTo(DireccionCarrera::class, 'direccion_id');
    }
}
