<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    // Si tu tabla se llama "roles" (plural)
    protected $table = 'roles';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
    ];

    // Relación con usuarios
    public function users()
    {
        return $this->hasMany(User::class, 'rol_id'); // un rol tiene muchos usuarios
    }
}
