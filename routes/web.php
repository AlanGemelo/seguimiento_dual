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
    Route::post('/estudiantes', [EstudiantesController::class, 'store'])->name('estudiantes.store');
    Route::get('/estudiantes/{matricula}/show', [EstudiantesController::class, 'show'])->name('estudiantes.show');
    Route::get('/estudiantes/{matricula}/json', [EstudiantesController::class, 'showJson'])->name('estudiantes.showJson');
    Route::get('/estudiantes/{matricula}/editar', [EstudiantesController::class, 'edit'])->name('estudiantes.edit');
    Route::patch('/estudiantes/{matricula}', [EstudiantesController::class, 'update'])->name('estudiantes.update');
    Route::delete('/estudiantes/{matricula}/delete', [EstudiantesController::class, 'destroy'])->name('estudiantes.destroy');

    Route::get('/academicos', [MentorAcademicoController::class, 'index'])->name('academicos.index');
    Route::get('/academicos/crear', [MentorAcademicoController::class, 'create'])->name('academicos.create');
    Route::post('/academicos', [MentorAcademicoController::class, 'store'])->name('academicos.store');
    Route::get('/academicos/{id}/show', [MentorAcademicoController::class, 'show'])->name('academicos.show');
    Route::get('/academicos/{id}/json', [MentorAcademicoController::class, 'show'])->name('academicos.showJson');
    Route::get('/academicos/{id}/editar', [MentorAcademicoController::class, 'edit'])->name('academicos.edit');
    Route::patch('/academicos/{id}', [MentorAcademicoController::class, 'update'])->name('academicos.update');
    Route::delete('/academicos/{id}/delete', [MentorAcademicoController::class, 'destroy'])->name('academicos.destroy');
});

require __DIR__.'/auth.php';
