<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Anexo1_1Controller;
use App\Http\Controllers\Anexo1_2Controller;
use App\Http\Controllers\Anexo1_3Controller;
use App\Http\Controllers\Anexo2_1Controller;
use App\Http\Controllers\EmpresaController;
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



Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    Debugbar::addMessage('Comando generado', 'listo!!');
})->name('optimize');
Route::get('/migrate', function () {
    Artisan::call('migrate');
    Debugbar::addMessage('Migraciones  generado', 'listo!!');
})->name('migrate');

//Captura rutas no definidas
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/', [HomeController::class, 'welcome']);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Rutas para el módulo estudiantes
    Route::get('/estudiantes', [EstudiantesController::class, 'index'])->name('estudiantes.index');
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

    //Rutas para el módulo Mentores academicos
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

    //Rutas para el empresas
    Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
    Route::get('/empresas/crear', [EmpresaController::class, 'create'])->name('empresas.create');
    // Route::post('/empresas/registrar', [EmpresaController::class, 'registrar'])->name('empresas.registrar');
    Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresas.store');
    //Route::post('/empresas/store', [EmpresaController::class, 'store'])->name('empresas.store');
    Route::get('/empresas/{id}/show', [EmpresaController::class, 'show'])->name('empresas.show');
    Route::get('/empresas/{id}/show_establecidas', [EmpresaController::class, 'show_establecidas'])->name('empresas.show_establecidas');
    Route::get('/empresas/{id}/json', [EmpresaController::class, 'showJson'])->name('empresas.showJson');
    Route::get('/empresas/{empresa}/editar', [EmpresaController::class, 'edit'])->name('empresas.edit');
    Route::patch('/empresas/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');
    Route::delete('/empresas/{id}/delete', [EmpresaController::class, 'destroy'])->name('empresas.destroy');
    Route::get('/empresas/{id}/suspend', [EmpresaController::class, 'suspendForm'])->name('empresas.suspendForm');
    Route::put('/empresas/{id}/suspend', [EmpresaController::class, 'suspend'])->name('empresas.suspend');
    Route::put('/empresas/{id}/reactivate', [EmpresaController::class, 'reactivate'])->name('empresas.reactivate');
    //  Route::resource('empresas', EmpresaController::class);
    Route::get('empresas/interesadas', [EmpresaController::class, 'interesadas'])->name('empresas.interesadas');
    Route::get('empresas/{empresa}/darAlta', [EmpresaController::class, 'darAlta'])->name('empresas.darAlta');
    Route::patch('empresas/{empresa}/registrar', [EmpresaController::class, 'registrar'])->name('empresas.registrar');
    Route::get('empresas/{empresa}/downloadPDF', [EmpresaController::class, 'downloadPDF'])->name('empresas.downloadPDF');
    Route::get('empresas/exportUeiPdf', [EmpresaController::class, 'exportUeiPdf'])->name('empresas.exportUeiPdf');

    // Rutas para el modulo de mentores Industriales
    Route::get('/mentores', [MentorIndustrialController::class, 'index'])->name('mentores.index');
    Route::get('/mentores/crear', [MentorIndustrialController::class, 'create'])->name('mentores.create');
    Route::post('/mentores', [MentorIndustrialController::class, 'store'])->name('mentores.store');
    Route::get('/mentores/{id}/show', [MentorIndustrialController::class, 'show'])->name('mentores.show');
    Route::get('/mentores/{id}/json', [MentorIndustrialController::class, 'showJson'])->name('mentores.showJson');
    Route::get('/mentores/{id}/editar', [MentorIndustrialController::class, 'edit'])->name('mentores.edit');
    Route::get('/mentores/{id}/empresa', [MentorIndustrialController::class, 'showForEmpresa']);
    Route::patch('/mentores/{id}', [MentorIndustrialController::class, 'update'])->name('mentores.update');
    Route::delete('/mentores/{id}/delete', [MentorIndustrialController::class, 'destroy'])->name('mentores.destroy');
    // Route::delete('/mentores/{id}', [MentorIndustrialController::class, 'destroy'])->name('mentores.destroy');
    // Route::delete('/mentores/{id}', [MentorIndustrialController::class, 'destroy'])->name('mentores.destroy');

    // Rutas para el modulo de carreras
    Route::get('/carreras/crear', [CarreraController::class, 'create'])->name('carreras.create');
    Route::get('/carreras', [CarreraController::class, 'index'])->name('carreras.index');
    Route::post('/carreras', [CarreraController::class, 'store'])->name('carreras.store');
    Route::get('/carreras/{id}/json', [CarreraController::class, 'showJson'])->name('carreras.showJson');
    Route::get('/carreras/{carrera}', [CarreraController::class, 'show'])->name('carreras.show');
    Route::patch('/carreras/{id}', [CarreraController::class, 'update'])->name('carreras.update');
    Route::delete('/carreras/{id}/delete', [CarreraController::class, 'destroy'])->name('carreras.destroy');
    Route::get('/carreras/{id}/editar', [CarreraController::class, 'edit'])->name('carreras.edit');
    Route::resource('estadisticas', EstadisticaController::class)->except(['show']);

    // Rutas para el modulo de mentores estadisticas
    Route::get('estadisticas/exportExcel', [EstadisticaController::class, 'exportExcel'])->name('estadisticas.exportExcel');
    Route::get('estadisticas/mentor/{mentorId}', [EstadisticaController::class, 'getEstudiantesPorMentor']);
    Route::get('estadisticas/empresa/{empresaId}', [EstadisticaController::class, 'getEstudiantesPorEmpresa']);
    Route::get('estadisticas/carrera/{carreraId}', [EstadisticaController::class, 'getEstudiantesPorCarrera']);
    Route::get('estadisticas/mentor/{mentorId}/excel', [EstadisticaController::class, 'exportEstudiantesPorMentorExcel']);
    Route::get('estadisticas/empresa/{empresaId}/excel', [EstadisticaController::class, 'exportEstudiantesPorEmpresaExcel']);
    Route::get('estadisticas/carrera/{carreraId}/excel', [EstadisticaController::class, 'exportEstudiantesPorCarreraExcel']);
    Route::get('estadisticas/mentor/{mentorId}/pdf', [EstadisticaController::class, 'exportEstudiantesPorMentorPdf']);
    Route::get('estadisticas/empresa/{empresaId}/pdf', [EstadisticaController::class, 'exportEstudiantesPorEmpresaPdf']);
    Route::get('estadisticas/carrera/{carreraId}/pdf', [EstadisticaController::class, 'exportEstudiantesPorCarreraPdf']);
    Route::get('estadisticas/status/{status}', [EstadisticaController::class, 'getEstudiantesPorStatus']);
    Route::get('estadisticas/beca/{beca}', [EstadisticaController::class, 'getEstudiantesPorBeca']);
    Route::get('estadisticas/status/{status}/excel', [EstadisticaController::class, 'exportEstudiantesPorStatusExcel']);
    Route::get('estadisticas/beca/{beca}/excel', [EstadisticaController::class, 'exportEstudiantesPorBecaExcel']);
    Route::get('/estadisticas/filtro/excel', [EstadisticaController::class, 'filtroEstudiantes']);
    Route::get('/estadisticas/filtro', [EstadisticaController::class, 'filtroEstudiantes']);
    Route::get('/estadisticas/graficas', [EstadisticaController::class, 'getGraficasData']);

    //Ruta para los reportes generales
    //  Route::get('/reporte-general', [EstadisticaController::class, 'reporteGeneral'])->name('reporte.general');
    Route::get('/reporte-general', [EstadisticaController::class, 'prueba'])->name('reporte.general');


    //Rutas para Direccion de carrera
    Route::get('/direcciones', [DireccionCarreraController::class, 'index'])->name('direcciones.index');
    Route::post('/direcciones', [DireccionCarreraController::class, 'store'])->name('direcciones.store');
    Route::get('/direcciones/{direccion}/show', [DireccionCarreraController::class, 'show'])->name('direcciones.show');
    Route::get('/direcciones/{id}/json', [DireccionCarreraController::class, 'showJson'])->name('direcciones.showJson');
    Route::patch('/direcciones/{direccion}', [DireccionCarreraController::class, 'update'])->name('direcciones.update');
    Route::delete('/direcciones/{direccion}/delete', [DireccionCarreraController::class, 'destroy'])->name('direcciones.destroy');
    Route::get('/direcciones/crear', [DireccionCarreraController::class, 'create'])->name('direcciones.create');
    Route::get('/direcciones/{direccion}/edit', [DireccionCarreraController::class, 'edit'])->name('direcciones.edit');
    Route::get('/direcciones/{direccion}/select', [DireccionCarreraController::class, 'select'])->name('direcciones.select');

    //Rutas RESTful 
    Route::resource('directores', DirectorController::class);
    Route::get('/directores/{id}/json', [DirectorController::class, 'showJson'])->name('direcciones.showJson');

    Route::post('alerts', [MentorAcademicoController::class, 'alerts'])->name('alerts');

    //Rutas para administracion de venciminetos
    Route::get('/documentacion', [DocumentacionController::class, 'index'])->name('documentacion.index');
    Route::put('/documentacion/renovar/estudiante/{id}', [DocumentacionController::class, 'renovarEstudiante'])->name('documentacion.renovar.estudiante');
    Route::put('/documentacion/renovar/convenio/{id}', [DocumentacionController::class, 'renovarConvenio'])->name('documentacion.renovar.convenio');

    // Rutas para Anexo 1.1
    Route::get('/anexo1_1', [Anexo1_1Controller::class, 'index'])->name('anexo1_1.index');
    Route::get('/anexo1_1/create', [Anexo1_1Controller::class, 'create'])->name('anexo1_1.create');
    Route::post('/anexo1_1', [Anexo1_1Controller::class, 'store'])->name('anexo1_1.store');
    Route::get('/anexo1_1/{anexo1_1}/edit', [Anexo1_1Controller::class, 'edit'])->name('anexo1_1.edit');
    Route::put('/anexo1_1/{anexo1_1}', [Anexo1_1Controller::class, 'update'])->name('anexo1_1.update');
    Route::delete('/anexo1_1/{anexo1_1}', [Anexo1_1Controller::class, 'destroy'])->name('anexo1_1.destroy');
    Route::get('/anexo1_1/{anexo1_1}/pdf', [Anexo1_1Controller::class, 'generatePdf'])->name('anexo1_1.generatePdf');
    Route::get('/anexo1_1/{anexo1_1}/word', [Anexo1_1Controller::class, 'generateWord'])->name('anexo1_1.generateWord');

    // Rutas para Anexo 1.2
    Route::get('/anexo1_2', [Anexo1_2Controller::class, 'index'])->name('anexo1_2.index');
    Route::get('/anexo1_2/create', [Anexo1_2Controller::class, 'create'])->name('anexo1_2.create');
    Route::post('/anexo1_2', [Anexo1_2Controller::class, 'store'])->name('anexo1_2.store');
    Route::get('/anexo1_2/{anexo1_2}/edit', [Anexo1_2Controller::class, 'edit'])->name('anexo1_2.edit');
    Route::put('/anexo1_2/{anexo1_2}', [Anexo1_2Controller::class, 'update'])->name('anexo1_2.update');
    Route::delete('/anexo1_2/{anexo1_2}', [Anexo1_2Controller::class, 'destroy'])->name('anexo1_2.destroy');
    Route::get('/anexo1_2/{anexo1_2}/pdf', [Anexo1_2Controller::class, 'generatePdf'])->name('anexo1_2.generatePdf');
    Route::get('/anexo1_2/{anexo1_2}/word', [Anexo1_2Controller::class, 'generateWord'])->name('anexo1_2.generateWord');

    // Rutas para Anexo 1.3
    Route::get('/anexo1_3', [Anexo1_3Controller::class, 'index'])->name('anexo1_3.index');
    Route::get('/anexo1_3/create', [Anexo1_3Controller::class, 'create'])->name('anexo1_3.create');
    Route::post('/anexo1_3', [Anexo1_3Controller::class, 'store'])->name('anexo1_3.store');
    Route::get('/anexo1_3/{anexo1_3}/edit', [Anexo1_3Controller::class, 'edit'])->name('anexo1_3.edit');
    Route::put('/anexo1_3/{anexo1_3}', [Anexo1_3Controller::class, 'update'])->name('anexo1_3.update');
    Route::delete('/anexo1_3/{anexo1_3}', [Anexo1_3Controller::class, 'destroy'])->name('anexo1_3.destroy');
    Route::get('/anexo1_3/{anexo1_3}/pdf', [Anexo1_3Controller::class, 'generatePdf'])->name('anexo1_3.generatePdf');
    Route::get('/anexo1_3/{anexo1_3}/word', [Anexo1_3Controller::class, 'generateWord'])->name('anexo1_3.generateWord');

    // Rutas para Anexo 2.1
    Route::get('/anexo2_1', [Anexo2_1Controller::class, 'index'])->name('anexo2_1.index');
    Route::get('/anexo2_1/create', [Anexo2_1Controller::class, 'create'])->name('anexo2_1.create');
    Route::post('/anexo2_1', [Anexo2_1Controller::class, 'store'])->name('anexo2_1.store');
    Route::get('/anexo2_1/{anexo2_1}/edit', [Anexo2_1Controller::class, 'edit'])->name('anexo2_1.edit');
    Route::put('/anexo2_1/{anexo2_1}', [Anexo2_1Controller::class, 'update'])->name('anexo2_1.update');
    Route::delete('/anexo2_1/{anexo2_1}', [Anexo2_1Controller::class, 'destroy'])->name('anexo2_1.destroy');
    Route::get('/anexo2_1/{anexo2_1}/pdf', [Anexo2_1Controller::class, 'generatePdf'])->name('anexo2_1.generatePdf');
    Route::get('/anexo2_1/{anexo2_1}/word', [Anexo2_1Controller::class, 'generateWord'])->name('anexo2_1.generateWord');

    // Rutas para Anexo 2.1 con Stepper
    Route::get('/anexo2_1/stepper', [Anexo2_1Controller::class, 'showStepper'])->name('anexo2_1.stepper');
    Route::post('/anexo2_1/stepper', [Anexo2_1Controller::class, 'storeStepper'])->name('anexo2_1.storeStepper');

    Route::resource('anexo2_1', Anexo2_1Controller::class);
    Route::get('anexo2_1/{anexo2_1}/generatePdf', [Anexo2_1Controller::class, 'generatePdf'])->name('anexo2_1.generatePdf');
    Route::get('anexo2_1/{anexo2_1}/generateWord', [Anexo2_1Controller::class, 'generateWord'])->name('anexo2_1.generateWord');

    // Rutas para la Navegación Principal
    // Route::get('/anexos', function () {
    //     return view('anexos.index');
    // })->name('anexos.index');

    // Route::get('/', function () {
    //     return redirect()->route('anexos.index');
    // });


    Route::get('/descargar/{archivo}', function ($archivo) {
        $path = public_path('storage/anexos/' . $archivo);
        if (file_exists($path)) {
            return response()->download($path);
        } else {
            abort(404); // Si el archivo no existe, mostrar error 404
        }
    });
});

require __DIR__ . '/auth.php';
