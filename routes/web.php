<?php

namespace App\Http\Controllers;

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

Route::get('/', [HomeController::class, 'welcome']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/estudiantes', [EstudiantesController::class, 'index'])->name('estudiantes.index');
    Route::get('/estudiantes/crear', [EstudiantesController::class, 'create'])->name('estudiantes.create');
    Route::get('/estudiantes/documentation', [EstudiantesController::class, 'updateForm'])->name('estudiantes.updateForm');
    Route::post('/estudiantes', [EstudiantesController::class, 'store'])->name('estudiantes.store');
    Route::get('/estudiantes/{matricula}/show', [EstudiantesController::class, 'show'])->name('estudiantes.show');
    Route::get('/estudiantes/{matricula}/json', [EstudiantesController::class, 'showJson'])->name('estudiantes.showJson');
    Route::get('/estudiantes/{matricula}/editar', [EstudiantesController::class, 'edit'])->name('estudiantes.edit');
    Route::patch('/estudiantes/{matricula}', [EstudiantesController::class, 'update'])->name('estudiantes.update');
    Route::delete('/estudiantes/{matricula}/delete', [EstudiantesController::class, 'destroy'])->name('estudiantes.destroy');
    Route::patch('/estudiantes/{id}/restaurar', [EstudiantesController::class, 'restoreEstudiante'])->name('estudiantes.restore');
    Route::delete('/estudiantes/{id}/force', [EstudiantesController::class, 'forceDelete'])->name('estudiantes.forceDelete');

    Route::get('/academicos', [MentorAcademicoController::class, 'index'])->name('academicos.index');
    Route::get('/academicos/crear', [MentorAcademicoController::class, 'create'])->name('academicos.create');
    Route::post('/academicos', [MentorAcademicoController::class, 'store'])->name('academicos.store');
    Route::get('/academicos/{id}/show', [MentorAcademicoController::class, 'show'])->name('academicos.show');
    Route::get('/academicos/{id}/json', [MentorAcademicoController::class, 'showJson'])->name('academicos.showJson');
    Route::get('/academicos/{id}/editar', [MentorAcademicoController::class, 'edit'])->name('academicos.edit');
    Route::patch('/academicos/{id}', [MentorAcademicoController::class, 'update'])->name('academicos.update');
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

    Route::get('/carreras', [CarreraController::class, 'index'])->name('carreras.index');
    Route::post('/carreras', [CarreraController::class, 'store'])->name('carreras.store');
    Route::get('/carreras/{id}/json', [CarreraController::class, 'showJson'])->name('carreras.showJson');
    Route::patch('/carreras/{id}', [CarreraController::class, 'update'])->name('carreras.update');
    Route::delete('/carreras/{id}/delete', [CarreraController::class, 'destroy'])->name('carreras.destroy');
    Route::get('/carreras/crear', [CarreraController::class, 'create'])->name('carreras.create');
    Route::get('/carreras/{id}/editar', [CarreraController::class, 'edit'])->name('carreras.edit');
    Route::resource('estadisticas', EstadisticaController::class);
});

require __DIR__ . '/auth.php';
