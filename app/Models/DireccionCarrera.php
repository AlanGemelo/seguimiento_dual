<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionCarrera extends Model
{
    use HasFactory;

    protected $table = 'direccion_carreras';

    protected $fillable = [
        'name',
        'email',
        'telefono',
    ];

    public function programas()
    {
        return $this->hasMany(Carrera::class, 'direccion_id', 'id');
    }
    public function director()
    {
        return $this->hasOne(Director::class, 'direccion_id', 'id');
    }
    public function empresas()
    {
    return $this->belongsToMany(Empresa::class, 'empresa_direccion', 'direccion_id', 'empresa_id');
    }
}
