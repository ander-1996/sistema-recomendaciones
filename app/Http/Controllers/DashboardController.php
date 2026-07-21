<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Recomendacion;
use App\Models\Seguimiento;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $instituciones = Institucion::count();

        $usuarios = User::count();

        $totalRecomendaciones = Recomendacion::count();

        $cumplidas = Recomendacion::where('estado', 'Cumplida')->count();

        $enProceso = Recomendacion::where('estado', 'En proceso')->count();

        $pendientes = Recomendacion::where('estado', 'Pendiente')->count();

        // Actualizar automáticamente recomendaciones vencidas

Recomendacion::where('estado', '!=', 'Cumplida')
    ->whereDate('fecha_cumplimiento', '<', now())
    ->update([
        'estado' => 'Vencida'
    ]);


// Actualizar automáticamente recomendaciones vencidas

Recomendacion::where('estado', '!=', 'Cumplida')
    ->whereDate('fecha_cumplimiento', '<', now())
    ->update([
        'estado' => 'Vencida'
    ]);


$vencidas = Recomendacion::where('estado', 'Vencida')->count();


        // Recomendaciones próximas a vencer en los próximos 7 días

$proximasAVencer = Recomendacion::with('institucion')
    ->where('estado', '!=', 'Cumplida')
    ->whereBetween('fecha_cumplimiento', [
        Carbon::now(),
        Carbon::now()->addDays(7)
    ])
    ->orderBy('fecha_cumplimiento')
    ->get();

        $porcentajeGeneral = $totalRecomendaciones > 0
            ? round(($cumplidas / $totalRecomendaciones) * 100)
            : 0;

        $ultimosSeguimientos = Seguimiento::with([
                'recomendacion',
                'usuario'
            ])
            ->latest()
            ->take(5)
            ->get();

            $recomendacionesPorInstitucion = Recomendacion::select(
        'institucions.nombre',
        DB::raw('count(*) as total')
    )
    ->join('institucions', 'recomendaciones.institucion_id', '=', 'institucions.id')
    ->groupBy('institucions.nombre')
    ->orderBy('institucions.nombre')
    ->get();

        return view('dashboard', compact(
            'instituciones',
            'usuarios',
            'totalRecomendaciones',
            'cumplidas',
            'enProceso',
            'pendientes',
            'vencidas',
            'proximasAVencer',
            'porcentajeGeneral',
            'ultimosSeguimientos',
            'recomendacionesPorInstitucion'
        ));
    }
}