<?php

namespace App\Http\Controllers;

use App\Models\DireccionCarrera;
use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function welcome(): View|RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    public function dashboard(){
        $direccion = DireccionCarrera::find(Auth::user()->direccion_id);

        session()->put('direccion',  $direccion ?? '');
        $estudiantes = Estudiantes::count();
        $mentores = MentorIndustrial::count();
        $auth = Auth::user();
        if($auth->rol_id == 1 )
        {
            session()->forget('direccion');
            $direcciones = DireccionCarrera::all();
    return view('dashboardSuperAdmin', compact(['estudiantes','mentores','direcciones']));
}
else if($auth->rol_id == 3){
    
    $estudiante = Estudiantes::withTrashed()->where('user_id', $auth->id)->first();
    return view('dashboardEstudiante',compact('estudiante'));
}
else if($auth->rol_id == 4){    
    return view('dashboard', compact(['estudiantes','mentores']));
}
else{
        return view('dashboard', compact(['estudiantes','mentores']));

    }
    }
}
