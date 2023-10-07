<?php

namespace App\Http\Controllers\Api;

use App\Models\Empresa;
use App\Models\Estudiantes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas=Empresa::all();

        return view('empresas.index', compact('empresas'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Empresa $empresa)
    {
        //
    }

    public function edit(Empresa $empresa)
    {
        //
    }

    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    public function destroy(Empresa $empresa)
    {
        //
    }
}
