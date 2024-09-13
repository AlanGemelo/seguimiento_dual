<?php

namespace App\Http\Controllers;

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

    public function dashboard(): View{
        $estudiantes = Estudiantes::count();
        $mentores = MentorIndustrial::count();
        $auth = Auth::user();
if($auth->rol_id == 1){
    return view('dashboard', compact(['estudiantes','mentores']));
}
else if($auth->rol_id == 3){
    
    $estudiante = Estudiantes::where('matricula', strtok($auth->email,'@'))->first();
    return view('dashboardEstudiante',compact('estudiante'));
}else{
        return view('dashboard', compact(['estudiantes','mentores']));

    }
    }
}
