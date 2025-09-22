<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class MentorAcademicoControllerTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function test_store_crea_mentor_academico()
    {
        $this->withoutExceptionHandling();

        // Simula un usuario autenticado
        $user = User::create([
            'titulo' => 'Mtro.',
            'name' => 'Usuario Test',
            'apellidoP' => 'ApellidoP',
            'apellidoM' => 'ApellidoM',
            'email' => 'usuario.test@example.com',
            'password' => Hash::make('12345678'),
            'rol_id' => 1,
            'direccion_id' => 1,
        ]);
        $this->actingAs($user);


        $requestData = [
            'titulo' => 'Mtro.',
            'name' => 'Carlos',
            'apellidoP' => 'Mendoza',
            'apellidoM' => 'Ruiz',
            'email' => 'carlos.mendoza@utvtol.edu.mx', // Usa email válido
            'direccion_id' => 2,
        ];

        $response = $this->post(route('academicos.store'), $requestData);

        $response->assertStatus(302);
        $response->assertRedirect(route('academicos.index'));
        $response->assertSessionHas('message', 'Mentor Académico creado correctamente');

        $this->assertDatabaseHas('users', [
            'name' => 'Carlos',
            'apellidoP' => 'Mendoza',
            'apellidoM' => 'Ruiz',
            'email' => 'carlos.mendoza@utvtol.edu.mx',
            'rol_id' => 2,
            'direccion_id' => 2,
        ]);

        $user = User::where('email', 'carlos.mendoza@utvtol.edu.mx')->first();
        $this->assertTrue(Hash::check('12345678', $user->password));
    }
}
