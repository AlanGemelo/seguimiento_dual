<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
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

        return view('dashboard', compact('estudiantes'));
    }
}
