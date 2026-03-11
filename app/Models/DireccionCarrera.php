<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DireccionCarrera extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'direccion_carreras';

    protected $fillable = [
        'name',
        'email',
        'ext_telefonica',
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
