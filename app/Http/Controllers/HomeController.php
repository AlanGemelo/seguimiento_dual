<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use App\Models\MentorIndustrial;
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

        return view('dashboard', compact(['estudiantes','mentores']));
    }
}
