<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo1_2 extends Model
{
    use HasFactory;
    protected $table = 'anexo_1_2';

    protected $fillable = [
        'fecha_elaboracion',
        'quien_elaboro_id',
        'nombre_firma_ie',
        'actividades'
    ];

    protected $casts = [
        'actividades' => 'array'
    ];

    public function quienElaboro()
    {
        return $this->belongsTo(User::class, 'quien_elaboro_id');
    }

    public function getNombreQuienElaboro()
    {
        return $this->quienElaboro->name;
    }
}
