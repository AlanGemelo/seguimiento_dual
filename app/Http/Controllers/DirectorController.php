<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectorRequest;
use App\Http\Requests\UpdateDirectorRequest;
use App\Models\DireccionCarrera;
use App\Models\Director;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Vinkla\Hashids\Facades\Hashids;

class DirectorController extends Controller
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
        $DireccionConDirector = Director::get('direccion_id')->pluck('direccion_id');
        // $direcciones = DireccionCarrera::whereNotIn('id', $DireccionConDirector)->get();
        $direcciones = DireccionCarrera::with('director')->get();

        // return response()->json($direcciones);
        return view('directores.create', compact('direcciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDirectorRequest $request)
    {
        $username = preg_replace('/\s+/', '', $request->email);
        $username = str_replace('@utvtol.edu.mx', '', $username);

        $emailCompleto = $username.'@utvtol.edu.mx';

        $request->merge(['email' => $emailCompleto]);

        Director::create($request->all());
        User::create([
            'titulo' => 'Director',
            'name' => $request->nombre,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'email' => $emailCompleto,
            'password' => bcrypt('12345678'),
            'rol_id' => 4,
            'carrera_id' => $request->null,
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
    public function show($directore)
    {
        $directore = Hashids::decode($directore);
        $directore = Director::findOrFail($directore)->first();
        $directore->load('direccion');

        return view('directores.show', ['director' => $directore]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function edit($directore)
    {
        $directore = Hashids::decode($directore);
        $directore = Director::findOrFail($directore)->first();
        $direcciones = DireccionCarrera::all();

        $directore->load('direccion');

        return view('directores.edit', ['direccion' => $directore, 'direcciones' => $direcciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDirectorRequest $request, Director $directore)
    {

        User::where('email', $directore->email)->update([
            'name' => $request->nombre,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'email' => $request->email,

            'direccion_id' => $request->direccion_id,
        ]);
        $directore->update($request->all());

        return redirect()->route('directores.index');
    }

    public function showJson($hash): JsonResponse
    {
        try {
            $decoded = Hashids::decode($hash);

            if (empty($decoded)) {
                return response()->json(['error' => 'ID invalido'], 404);
            }

            $director = Director::find($decoded[0]);

            if (! $director) {
                return response()->json(['error' => 'Director no encontrado'], 404);
            }

            return response()->json($director);

        } catch (\Exception $e) {
            // Captura cualquier error interno
            return response()->json(['error' => 'Error interno: '.$e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $decoded = Hashids::decode($id);

        if (count($decoded) === 0) {
            abort(404);
        }
        $directorId = $decoded[0];

        $directore = Director::find($directorId);
        if (! $directore) {
            abort(404);
        }

        $user = User::where('email', $directore->email)->first();
        if ($user) {
            $user->delete();
        }

        $directore->delete();

        return redirect()->route('directores.index')->with('success', 'Director eliminado correctamente.');
    }
}
