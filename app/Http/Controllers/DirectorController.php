<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Http\Requests\StoreDirectorRequest;
use App\Http\Requests\UpdateDirectorRequest;
use App\Models\DireccionCarrera;
use App\Models\User;
use Illuminate\Http\Client\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directores = Director::with('direccion')->get();
        return view('directores.index', ['directores' => $directores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $direcciones = DireccionCarrera::all();
        return view('directores.create',compact('direcciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDirectorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDirectorRequest $request)
    {
        Director::create($request->all());
        User::create([
            'titulo' => 'Director',
            'name'=> $request->nombre,
            'email' => $request->email,
            'password' => bcrypt(12345678),
            'rol_id' => 4,
            'carrera_id' => $request->carrera_id,
            'direccion_id' => $request->direccion_id,
        ]);
        return redirect()->route('directores.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function show(Director $directore)
    {
        return $directore;
        $directore->load('direccion');
        return view('directores.show', ['director' => $directore]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit(Director $directore)
    {
        $direcciones = DireccionCarrera::all();
         $directore->load('direccion');
        return view('directores.edit', ['direccion' => $directore, 'direcciones' => $direcciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDirectorRequest  $request
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDirectorRequest $request, Director $directore)
    {
        
        User::where('email', $directore->email)->update([
            'name' => $request->nombre,
            'email' => $request->email,
            'direccion_id' => $request->direccion_id,
        ]);
        $directore->update($request->all());
        
        return redirect()->route('directores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy(Director $director)
    {
        $director->delete();
        return redirect()->route('directores.index');
    }
}
