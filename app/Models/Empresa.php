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
        'telefono'
    ];
    public function asesorin(): BelongsTo
    {
        return $this->belongsTo(MentorIndustrial::class, 'id', 'empresa_id');
    }
 

}
