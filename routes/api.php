<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/estudiantes', [EstudiantesController::class, 'index'])->name('estudiantes.index');
    Route::post('/estudiantes/store', [EstudiantesController::class, 'store'])->name('estudiantes.store');
    Route::get('/estudiantes/{matricula}/show', [EstudiantesController::class, 'show'])->name('estudiantes.show');
    Route::get('/estudiantes/{matricula}/editar', [EstudiantesController::class, 'edit'])->name('estudiantes.edit');
    Route::patch('/estudiantes/{matricula}', [EstudiantesController::class, 'update'])->name('estudiantes.update');
    Route::delete('/estudiantes/{matricula}/delete', [EstudiantesController::class, 'destroy'])->name('estudiantes.destroy');

    Route::get('/academicos', [MentorAcademicoController::class, 'index'])->name('academicos.index');
    Route::post('/academicos/store', [MentorAcademicoController::class, 'store'])->name('academicos.store');
    Route::get('/academicos/{id}/show', [MentorAcademicoController::class, 'show'])->name('academicos.show');
    Route::get('/academicos/{id}/editar', [MentorAcademicoController::class, 'edit'])->name('academicos.edit');
    Route::patch('/academicos/{id}', [MentorAcademicoController::class, 'update'])->name('academicos.update');
    Route::delete('/academicos/{id}/delete', [MentorAcademicoController::class, 'destroy'])->name('academicos.destroy');

    Route::get('/empresas/store', [EmpresaController::class, 'index'])->name('empresas.index');
    Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresas.store');
    Route::get('/empresas/{id}/show', [EmpresaController::class, 'show'])->name('empresas.show');
    Route::get('/empresas/{id}/editar', [EmpresaController::class, 'edit'])->name('empresas.edit');
    Route::patch('/empresas/{id}', [EmpresaController::class, 'update'])->name('empresas.       update');
    Route::delete('/empresas/{id}/delete', [EmpresaController::class, 'destroy'])->name('empresas.destroy');
});
