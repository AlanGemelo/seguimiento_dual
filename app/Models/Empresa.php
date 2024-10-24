<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'inicio_conv',
        'fin_conv',
        'convenioA',
        'convenioMA',
        'email',
        'telefono',
        'direccion_id'
    ];
    public function asesorin(): BelongsTo
    {
        return $this->belongsTo(MentorIndustrial::class, 'id', 'empresa_id');
    }
    public function direccion(){
        return $this->belongsTo(DireccionCarrera::class, 'direccion_id', 'id');        
    }
 

}
