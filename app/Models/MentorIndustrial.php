<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorIndustrial extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'name',
        'apellidoP',
        'apellidoM',
        'puesto',
        'empresa_id',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
    
    public function estudiantes()
    {
        return $this->hasMany(Estudiantes::class, 'asesorin_id', 'id');
    }
}
