<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\RecomendacionController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\RegistroRecomendacionController;
use App\Http\Controllers\RecomendacionPublicaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\EnlaceInstitucionController;
use App\Http\Controllers\PortalInstitucionController;



Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

Route::resource('recomendaciones', RecomendacionController::class)
    ->parameters([
        'recomendaciones' => 'recomendacion',
    ]);



Route::get(
    'recomendaciones/{recomendacion}/seguimiento',
    [SeguimientoController::class, 'show']
)->name('seguimientos.show');

Route::post(
    'recomendaciones/{recomendacion}/seguimiento',
    [SeguimientoController::class, 'store']
)->name('seguimientos.store');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

        Route::resource('instituciones', InstitucionController::class)
    ->parameters([
        'instituciones' => 'institucion'
    ]);



Route::get('/reportes', [ReporteController::class,'index'])
    ->name('reportes.index');


    Route::get('/reportes/exportar-excel',
    [ReporteController::class,'exportarExcel']
)->name('reportes.excel');

Route::get(
    '/reportes/recomendacion/{id}/pdf',
    [ReporteController::class,'pdf']
)->name('reportes.pdf');

});


Route::get('/registrar-recomendacion',
    [RecomendacionPublicaController::class, 'create'])
    ->name('registro.create');

Route::post('/registrar-recomendacion',
    [RecomendacionPublicaController::class, 'store'])
    ->name('registro.store');

require __DIR__.'/auth.php';


Route::get('/recomendacion/crear', [RecomendacionPublicaController::class, 'create'])
    ->name('recomendacion.public.create');

Route::post('/recomendacion/guardar', [RecomendacionPublicaController::class, 'store'])
    ->name('recomendacion.public.store');

    Route::get('/consulta/{codigo}', [RecomendacionPublicaController::class, 'consultar'])
    ->name('recomendacion.public.consultar');

    Route::get(
'/admin/institucion/{id}/crear-enlace',
[EnlaceInstitucionController::class,'crear']
)
->middleware('auth')
->name('crear.enlace');

Route::get(
    '/institucion/{token}',
    [PortalInstitucionController::class,'index']
)
->name('portal.institucion');