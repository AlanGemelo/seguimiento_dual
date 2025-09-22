<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Alumno; // Asegúrate de que exista este modelo
use App\Models\User;   // Si se requiere autenticación

class AlumnoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guarda_un_alumno()
    {
        // Si requiere autenticación, crea un usuario y actúa como él
        $user = User::factory()->create();
        $this->actingAs($user);

        // Datos válidos de prueba
        $datos = [
            'nombre' => 'Juan Pérez',
            'matricula' => 'A12345678',
            'email' => 'juan.perez@example.com',
            'telefono' => '5551234567',
            // Agrega aquí los demás campos requeridos por el modelo o validador
        ];

        // Ejecutar la solicitud POST al store()
        $response = $this->post(route('alumnos.store'), $datos);

        // Verificar redirección (puede variar según implementación)
        $response->assertStatus(302); // o assertRedirect('ruta')

        // Verificar que los datos están en la base de datos
        $this->assertDatabaseHas('alumnos', [
            'nombre' => 'Juan Pérez',
            'matricula' => 'A12345678',
            'email' => 'juan.perez@example.com',
        ]);
    }
}
