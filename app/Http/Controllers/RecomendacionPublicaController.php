<?php

namespace App\Http\Controllers;

use App\Models\Recomendacion;
use App\Models\Institucion;
use Illuminate\Http\Request;

class RecomendacionPublicaController extends Controller
{
    public function create()
    {
        $instituciones = Institucion::orderBy('nombre')->get();

        return view('recomendaciones.public.create', compact('instituciones'));
    }


    public function store(Request $request)
    {

    $request->validate([
    'institucion_id' => 'required|exists:institucions,id',
    'titulo' => 'required',
    'tipo' => 'required',
    'prioridad' => 'required',
]);


$recomendacion = Recomendacion::create([

    'codigo' => 'REC-' . str_pad(
        Recomendacion::count() + 1,
        4,
        '0',
        STR_PAD_LEFT
    ),
'institucion_origen' => $request->institucion_origen,
'institucion_id' => $request->institucion_id,

    // Datos de quien registra la recomendación
    'nombre_contacto'   => $request->nombre_contacto,
    'cargo_contacto'    => $request->cargo_contacto,
    'correo_contacto'   => $request->correo_contacto,
    'telefono_contacto' => $request->telefono_contacto,

    // Información de la recomendación
    'recomendacion' => $request->titulo,
    'hallazgo'      => $request->hallazgo,
    'tipo'          => $request->tipo,
    'prioridad'     => $request->prioridad,
    'responsable'   => $request->responsable_sugerido,

    'fecha_inicio'         => now()->toDateString(),
    'fecha_cumplimiento' => $request->fecha_cumplimiento,
    'estado'               => 'Pendiente',
]);


return redirect()
    ->back()
    ->with('success', 'Recomendación registrada correctamente')
    ->with('link_consulta', route('recomendacion.public.consultar', $recomendacion->codigo));
    }

    public function consultar($codigo)
{
    $recomendacion = Recomendacion::where('codigo', $codigo)
    ->with([
        'instituciones',
        'seguimientos.usuario'
    ])
    ->firstOrFail();

    return view('recomendaciones.public.consulta', compact('recomendacion'));
}
}

