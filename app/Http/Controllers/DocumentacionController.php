<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DocumentacionController extends Controller
{
    public function index()
    {
        $hoy = Carbon::now();

        $estudiantes = Estudiantes::whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
            ->where('activo', true)
            ->get();

        $convenios = Empresa::whereDate('fin_conv', '<=', $hoy->copy()->addDays(15))
            ->get();

        return view('admin.documentacion.index', compact('estudiantes', 'convenios'));
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
}
