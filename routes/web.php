<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('directores', DirectorController::class);
Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    Debugbar::addMessage('Comando generado', 'listo!!');

    // return 'EL gemelo es mi pastor y lo chapulin no a de faltar';

})->name('optimize');


Route::get('/', [HomeController::class, 'welcome']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/estudiantes', [EstudiantesController::class, 'index'])->name('estudiantes.index');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/estudiantes/crear', [EstudiantesController::class, 'create'])->name('estudiantes.create');
    Route::get('/estudiantes/crearC', [EstudiantesController::class, 'crearC'])->name('estudiantes.crearC');
    Route::get('/estudiantes/documentation', [EstudiantesController::class, 'updateForm'])->name('estudiantes.updateForm');
    Route::post('/candidatos', [EstudiantesController::class, 'candidato'])->name('estudiantes.candidatos');
    Route::post('/estudiantes', [EstudiantesController::class, 'store'])->name('estudiantes.store');
    Route::get('/estudiantes/{matricula}/show', [EstudiantesController::class, 'show'])->name('estudiantes.show');
    Route::get('/estudiantes/{matricula}/showC', [EstudiantesController::class, 'showC'])->name('estudiantes.showC');
    Route::get('/estudiantes/{matricula}/json', [EstudiantesController::class, 'showJson'])->name('estudiantes.showJson');
    Route::get('/estudiantes/{matricula}/editar', [EstudiantesController::class, 'edit'])->name('estudiantes.edit');
    Route::delete('/estudiantes/{matricula}/delete', [EstudiantesController::class, 'destroy'])->name('estudiantes.destroy');
    Route::patch('/estudiantes/{id}/restaurar', [EstudiantesController::class, 'restoreEstudiante'])->name('estudiantes.restore');
    Route::delete('/estudiantes/{id}/force', [EstudiantesController::class, 'forceDelete'])->name('estudiantes.forceDelete');
    Route::patch('/estudiantes/{matricula}', [EstudiantesController::class, 'update'])->name('estudiantes.update');
    Route::patch('/estudiantes/{matricula}/dual', [EstudiantesController::class, 'updateDocDual'])->name('estudiantes.updateDocDual');

    Route::get('/academicos', [MentorAcademicoController::class, 'index'])->name('academicos.index');
    Route::get('/academicos/crear', [MentorAcademicoController::class, 'create'])->name('academicos.create');
    Route::post('/academicos', [MentorAcademicoController::class, 'store'])->name('academicos.store');
    Route::get('/academicos/{id}/show', [MentorAcademicoController::class, 'show'])->name('academicos.show');
    Route::get('/academicos/{id}/json', [MentorAcademicoController::class, 'showJson'])->name('academicos.showJson');
    Route::get('/academicos/{id}/editar', [MentorAcademicoController::class, 'edit'])->name('academicos.edit');
    Route::patch('/academicos/{id}', [MentorAcademicoController::class, 'update'])->name('academicos.update');
    Route::get('/academicos/{id}/showE', [MentorAcademicoController::class, 'showE'])->name('academicos.showE');
    Route::delete('/academicos/{id}/delete', [MentorAcademicoController::class, 'destroy'])->name('academicos.destroy');
    Route::patch('/academicos/{id}/restaurar', [MentorAcademicoController::class, 'restoreMentor'])->name('academicos.restore');
    Route::delete('/academicos/{id}/force', [MentorAcademicoController::class, 'forceDelete'])->name('academicos.forceDelete');

    Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
    Route::get('/empresas/crear', [EmpresaController::class, 'create'])->name('empresas.create');
    Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresas.store');
    Route::get('/empresas/{id}/show', [EmpresaController::class, 'show'])->name('empresas.show');
    Route::get('/empresas/{id}/json', [EmpresaController::class, 'showJson'])->name('empresas.showJson');
    Route::get('/empresas/{id}/editar', [EmpresaController::class, 'edit'])->name('empresas.edit');
    Route::patch('/empresas/{id}', [EmpresaController::class, 'update'])->name('empresas.update');
    Route::delete('/empresas/{id}/delete', [EmpresaController::class, 'destroy'])->name('empresas.destroy');

    Route::get('/mentores', [MentorIndustrialController::class, 'index'])->name('mentores.index');
    Route::get('/mentores/crear', [MentorIndustrialController::class, 'create'])->name('mentores.create');
    Route::post('/mentores', [MentorIndustrialController::class, 'store'])->name('mentores.store');
    Route::get('/mentores/{id}/show', [MentorIndustrialController::class, 'show'])->name('mentores.show');
    Route::get('/mentores/{id}/json', [MentorIndustrialController::class, 'showJson'])->name('mentores.showJson');
    Route::get('/mentores/{id}/editar', [MentorIndustrialController::class, 'edit'])->name('mentores.edit');
    Route::get('/mentores/{id}/empresa', [MentorIndustrialController::class, 'showForEmpresa']);
    Route::patch('/mentores/{id}', [MentorIndustrialController::class, 'update'])->name('mentores.update');
    Route::delete('/mentores/{id}/delete', [MentorIndustrialController::class, 'destroy'])->name('mentores.destroy');

    Route::get('/carreras/crear', [CarreraController::class, 'create'])->name('carreras.create');
    Route::get('/carreras', [CarreraController::class, 'index'])->name('carreras.index');
    Route::post('/carreras', [CarreraController::class, 'store'])->name('carreras.store');
    Route::get('/carreras/{id}/json', [CarreraController::class, 'showJson'])->name('carreras.showJson');
    Route::get('/carreras/{carrera}', [CarreraController::class, 'show'])->name('carreras.show');
    Route::patch('/carreras/{id}', [CarreraController::class, 'update'])->name('carreras.update');
    Route::delete('/carreras/{id}/delete', [CarreraController::class, 'destroy'])->name('carreras.destroy');
    Route::get('/carreras/{id}/editar', [CarreraController::class, 'edit'])->name('carreras.edit');
    Route::resource('estadisticas', EstadisticaController::class);

    Route::get('/direcciones', [DireccionCarreraController::class, 'index'])->name('direcciones.index');
    Route::post('/direcciones', [DireccionCarreraController::class, 'store'])->name('direcciones.store');
    Route::get('/direcciones/{direccion}/show', [DireccionCarreraController::class, 'show'])->name('direcciones.show');
    Route::get('/direcciones/{id}/json', [DireccionCarreraController::class, 'showJson'])->name('direcciones.showJson');
    Route::patch('/direcciones/{direccion}', [DireccionCarreraController::class, 'update'])->name('direcciones.update');
    Route::delete('/direcciones/{direccion}/delete', [DireccionCarreraController::class, 'destroy'])->name('direcciones.destroy');
    Route::get('/direcciones/crear', [DireccionCarreraController::class, 'create'])->name('direcciones.create');
    Route::get('/direcciones/{direccion}/edit', [DireccionCarreraController::class, 'edit'])->name('direcciones.edit');

    Route::post('alerts', [MentorAcademicoController::class, 'alerts'])->name('alerts');
});

// Descargar Anexos
Route::get('/descargar/{archivo}', function ($archivo) {
    $path = public_path('storage/anexos/' . $archivo);
    if (file_exists($path)) {
        return response()->download($path);
    } else {
        abort(404); // Si el archivo no existe, mostrar error 404
    }
});
Route::get('/direcciones/{direccion}/select', [DireccionCarreraController::class, 'select'])->name('direcciones.select');


require __DIR__ . '/auth.php';
