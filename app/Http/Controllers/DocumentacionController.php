<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DocumentacionController extends Controller
{

    //    -- Estatus---
    //     0-Primera vez
    //     1-Renovacion Dual
    //     2-Reprobacion
    //     3-Terminio de convenio
    //     4-Ciclo de renovacion concluido
    //     5-Termino del PE

    public function index()
    {
        $situation = [
            ['id' => 0, 'name' => 'Reprobacion'],
            ['id' => 1, 'name' => 'Termino de Convenio'],
            ['id' => 2, 'name' => 'Ciclo de Renovacion Concluido'],
            ['id' => 3, 'name' => 'Termino del PE']
        ];

        $hoy = Carbon::now();

        $estudiantes = Estudiantes::whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
            ->where('activo', true)
            ->get();

        $convenios = Empresa::whereDate('fin_conv', '<=', $hoy->copy()->addDays(15))
            ->get();

        return view('admin.documentacion.index', compact('estudiantes', 'convenios', 'situation'));
    }

    public function renovarEstudiante($id)
    {
        try {
            $estudiante = Estudiantes::findOrFail($id);
            $estudiante->update([
                'fin_dual' => now()->addYear(),
                'status' => 1
            ]);

            return back()->with('success', 'Periodo dual actualizado correctamente.');
        } catch (\Exception $e) {
            // Puedes registrar el error en logs
            \Log::error("Error al renovar estudiante: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al actualizar el periodo dual.');
        }
    }

    public function renovarConvenio($id)
    {
        try {
            $empresa = Empresa::findOrFail($id);
            $empresa->update(['fin_conv' => now()->addYear()]);

            return back()->with('success', 'Convenio actualizado correctamente.');
        } catch (\Exception $e) {
            \Log::error("Error al renovar convenio: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al actualizar el convenio.');
        }
    }

    /**
     * Elimina un estudiante.
     */
    public function destroyEstudiante($id, Request $request)
    {
        try {

            $request->validate([
                'status' => 'required'
            ]);

            $estudiante = Estudiantes::findOrFail($id);
            $estudiante->update([
                'status' => $request->status,
            ]);
            $estudiante->delete();

            return redirect()->route('estudiantes.index')->with('status', 'Estudiante eliminado correctamente');
        } catch (\Exception $e) {
            \Log::error("Error al eliminar al estudiante: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al actualizar estado del estudiante.');
        }
    }
}
