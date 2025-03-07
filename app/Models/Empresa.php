<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'email',
        'direccion',
        'telefono',
        'inicio_conv',
        'fin_conv',
        'ine',
        'direccion_id',
        'convenioA',
        'convenioMA',
        // Nuevos campos
        'unidad_economica',
        'fecha_registro',
        'razon_social',
        'nombre_representante',
        'cargo_representante',
        'actividad_economica',
        'tamano_ue',
        'folio',
        'status',
    ];

    public function asesorin(): BelongsTo
    {
        return $this->belongsTo(MentorIndustrial::class, 'id', 'empresa_id');
    }

    public function direcciones()
    {
        return $this->belongsTo(DireccionCarrera::class, 'direccion_id', 'id');
    }
}
