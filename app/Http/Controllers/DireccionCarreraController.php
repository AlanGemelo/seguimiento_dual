<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Http\Requests\StoreDireccionCarreraRequest;
use App\Http\Requests\UpdateDireccionCarreraRequest;
use App\Models\Carrera;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DireccionCarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select(DireccionCarrera $direccion){
        session(['direccion' => $direccion]);
        $carreras = Carrera::with('direccion')->where('direccion_id',session('direccion')->id)->get();

        return view('carrera.index',compact('carreras'));
    }
    public function index()
    {
        $direcciones = DireccionCarrera::all();
        return view('direccionescarrera.index',compact('direcciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('direccionescarrera.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDireccionCarreraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $direccion = DireccionCarrera::create($request->all());
        return redirect()->route('direcciones.index',compact('direccion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function show(DireccionCarrera $direccion)
    {

        $direccion->load('programas','director');
        return view('direccionescarrera.show', compact('direccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function edit(DireccionCarrera $direccion)
    {

        return view('direccionescarrera.edit', compact('direccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDireccionCarreraRequest  $request
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DireccionCarrera $direccion)
    {
        $direccion->update($request->all());
        
        return redirect()->route('direcciones.index')->with('message', 'Direccion Academico Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DireccionCarrera  $direccionCarrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(DireccionCarrera $direccion)
    {

        
        try {
            $direccion->delete();

            return redirect()->route('direcciones.index')->with('messageDelete', 'Direccion Academico Eliminado Correctamente');

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1451) {
                dd($e);
                // Error de integridad referencial (clave foránea)
                return redirect()->route('direcciones.index')->with('statusError', 'No se puede eliminar la direccion de carrera. Primero elimina los programas educativos  asociados');
            }

            // Otro tipo de error, puedes manejarlo según tus necesidades
            // return redirect()->route('direcciones.index')->with('statusError', 'Error al eliminar la direccion de carrera: ' . $e->getMessage());
        }
    }
}
