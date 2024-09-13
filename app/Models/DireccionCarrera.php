<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DireccionCarrera extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'telefono',
      
    ];
    public function programas()
    {
        return $this->hasMany(Carrera::class, 'direccion_id', 'id');

    }
}
