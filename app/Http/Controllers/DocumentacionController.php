<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use App\Models\Empresa;
use App\Models\Convenio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DocumentacionController extends Controller
{

    //    -- Estatus---
    //     0-Primera vez
    //     1-Renovacion Dual
    //     2-Reprobacion
    //     3-Terminio de convenio
    //     4-Ciclo de renovacion concluido
    //     5-Termino del PE

    public function index(Request $request)
    {
        $user = Auth::user();

        $direccionId = session('direccion')?->id ?? null;
        $carreraId = session('carrera')?->id ?? null;

        $activeTab = $request->input('tab', 'dual');

        $search = $request->input('search');
        $searchUE = $request->input('search_ue');

        $hoy = Carbon::now();
        $limite = $hoy->copy()->addDays(15);

        // Query base estudiantes
        $query = Estudiantes::with('academico', 'carrera', 'usuario')
            ->where('activo', true)
            ->whereNotNull('fin_dual')
            ->where(function ($q) use ($hoy, $limite) {
                $q->whereDate('fin_dual', '<', $hoy)
                    ->orWhereBetween('fin_dual', [$hoy, $limite]);
            });

        // Filtro por rol mentor académico
        if ($user->rol_id == 2) {
            $query->where('academico_id', $user->id);
        }

        // Filtro por rol director de carrera
        elseif ($user->rol_id == 3) {
            if ($carreraId) {
                $query->where('carrera_id', $carreraId);
            }
        }

        // Filtro para admin u otros roles
        else {
            if ($direccionId) {
                $query->where('direccion_id', $direccionId);
            }
        }

        // Filtro de búsqueda
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(apellidoP) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(apellidoM) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(matricula) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        // Paginación estudiantes
        $estudiantes = $query->orderBy('fin_dual', 'asc')
            ->paginate(10)
            ->appends($request->all());

        // Estudiantes próximos
        $estudiantes_proximos = (clone $query)
            ->whereBetween('fin_dual', [$hoy, $limite])
            ->get();

        // Estudiantes vencidos
        $estudiantes_vencidos = (clone $query)
            ->whereDate('fin_dual', '<', $hoy)
            ->get();

        // Empresas activas
        $empresasQuery = Empresa::where('status', 1)
            ->withCount('estudiantes')
            ->orderBy('nombre', 'asc');

        $empresas = $empresasQuery->paginate(10)->appends($request->all());

        // Convenios próximos
        $convenios_proximos = Convenio::with('empresa')
            ->whereBetween('fin', [$hoy, $limite])
            ->get();

        // Convenios vencidos
        $convenios_vencidos = Convenio::with('empresa')
            ->whereDate('fin', '<', $hoy)
            ->get();

        // Situaciones de seguimiento
        $situation = [
            ['id' => 0, 'name' => 'Reprobacion'],
            ['id' => 1, 'name' => 'Termino de Convenio'],
            ['id' => 2, 'name' => 'Ciclo de Renovacion Concluido'],
            ['id' => 3, 'name' => 'Termino del PE']
        ];

        return view('admin.renovaciones.index', compact(
            'estudiantes',
            'estudiantes_proximos',
            'estudiantes_vencidos',
            'empresas',
            'convenios_proximos',
            'convenios_vencidos',
            'situation',
            'search',
            'searchUE'
        ));
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

    public function showRenovarEstudiante($id): View
    {
        $estudiante = Estudiantes::with('carrera')->findOrFail($id);

        return view('admin.renovaciones.duales.renovar', compact('estudiante'));
    }

    public function storeRenovarEstudiante(Request $request, $id)
    {
        $request->validate([
            'fin_dual' => 'required|date'
        ]);

        $estudiante = Estudiantes::findOrFail($id);

        $estudiante->update([
            'fin_dual' => $request->fin_dual,
            'status' => 1 // Renovación
        ]);

        return redirect()
            ->route('estudiantes.index', ['tab' => 'dual'])
            ->with('success', 'Periodo dual actualizado correctamente.');
    }

    public function showRenovarEmpresa($id): View
    {
        $empresa = Empresa::with(['convenios' => function ($q) {
            $q->latest();
        }])->findOrFail($id);

        $convenio = $empresa->convenios->first();

        return view('admin.renovaciones.unidadesEconomicas.renovar', compact('empresa', 'convenio'));
    }

    public function storeRenovarEmpresa(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio',
            'archivo' => 'nullable|file|mimes:pdf',
            'version' => 'nullable|string'
        ]);

        $empresa = Empresa::findOrFail($id);

        $path = null;

        if ($request->hasFile('archivo')) {
            $path = $request->file('archivo')->store('convenios', 'public');
        }

        Convenio::create([
            'empresa_id' => $empresa->id,
            'tipo' => $request->tipo,
            'inicio' => $request->inicio,
            'fin' => $request->fin,
            'archivo' => $path,
            'version' => $request->version,
        ]);

        return redirect()
            ->route('empresas.index', ['tab' => 'empresas'])
            ->with('success', 'Convenio renovado correctamente.');
    }
}
