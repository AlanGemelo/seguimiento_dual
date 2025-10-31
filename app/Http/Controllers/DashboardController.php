<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Estudiantes;
use App\Models\Empresa;

class DashboardController extends Controller
{

    public function __construct() {}

    public function index()
    {
        $hoy = Carbon::now();

        $registros = Estudiantes::with('academico', 'asesorin')
            ->whereDate('fin_dual', '<=', $hoy->copy()->addDays(15))
            ->where('activo', true)
            ->get();

        $registrosConvenio = Empresa::with('asesorin')
            ->whereDate('fin_conv', '<=', $hoy->copy()->addDays(15))
            ->get();
    }
}
