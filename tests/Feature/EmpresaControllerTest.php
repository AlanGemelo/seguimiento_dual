<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Empresa;
use Illuminate\Foundation\Testing\WithoutMiddleware;
 

class EmpresaControllerTest extends TestCase
{

      use WithoutMiddleware; // Desactiva middleware en este test o en todos los tests de esta clase
    

    /** @test */
    public function test_suspend_actualiza_empresa_y_redirige()
    {
        // Crear empresa manualmente
        $empresa = Empresa::create([
            'nombre' => 'Empresa de prueba',
            'email' => 'test@example.com',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '1234567890',
            'inicio_conv' => '2025-01-01',
            'fin_conv' => '2025-12-31',
            'convenioA' => 'fakepath/convenioA.pdf',
            'convenioMA' => 'fakepath/convenioMA.pdf',
            'status' => 1, // activo
        ]);

        // Datos para suspender
        $suspendData = [
            'motivo_baja' => 'Quiebra',
            'fecha_baja' => '2025-08-01',
            'comentarios' => 'Sanción temporal',
        ];

        // Petición POST
        $response = $this->put(route('empresas.suspend', $empresa->id), $suspendData);


        // Verificaciones
        $response->assertStatus(302);
        $response->assertRedirect(route('empresas.index'));
        $response->assertSessionHas('success', 'La empresa ha sido suspendida temporalmente.');

       
    }
}
