<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Recomendacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecomendacionController extends Controller
{
    /**
     * Listado
     */
public function index(Request $request)
{
    $query = Recomendacion::with('instituciones');

    if ($request->filled('codigo')) {
        $query->where('codigo', 'like', '%' . $request->codigo . '%');
    }


    $recomendaciones = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    $instituciones = Institucion::orderBy('nombre')->get();

    return view('recomendaciones.index', compact(
        'recomendaciones',
        'instituciones'
    ));
}

    /**
     * Formulario crear
     */
    public function create()
    {
        $instituciones = Institucion::orderBy('nombre')->get();

        return view('recomendaciones.create', compact('instituciones'));
    }

    /**
     * Guardar
     */
    public function store(Request $request)
    {
        $request->validate([
            'institucion_id' => 'required|exists:institucions,id',
            'recomendacion' => 'required',
            'tipo' => 'required',
            'hallazgo' => 'required',
            'prioridad' => 'required',
            'responsable' => 'nullable',
            'fecha_cumplimiento' => 'required|date',
            'estado' => 'required',
        ]);

        // Generar código consecutivo
        $ultimo = Recomendacion::latest()->first();

        if ($ultimo) {
            $numero = intval(substr($ultimo->codigo, -4)) + 1;
        } else {
            $numero = 1;
        }

        $codigo = 'REC-' . date('Y') . '-' . str_pad($numero, 4, '0', STR_PAD_LEFT);

        Recomendacion::create([
            'codigo' => $codigo,
            'institucion_id' => $request->institucion_id,
            'recomendacion' => $request->recomendacion,
            'tipo' => $request->tipo,
            'hallazgo' => $request->hallazgo,
            'prioridad' => $request->prioridad,
            'responsable' => $request->responsable,
            'fecha_inicio' => now()->toDateString(),
            'fecha_cumplimiento' => $request->fecha_cumplimiento,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('recomendaciones.index')
            ->with('success', 'Recomendación registrada correctamente.');
    }

    /**
     * Editar
     */
    public function edit(Recomendacion $recomendacion)
    {
        $instituciones = Institucion::orderBy('nombre')->get();

        return view(
            'recomendaciones.edit',
            compact('recomendacion', 'instituciones')
        );
    }

    /**
     * Actualizar
     */
    public function update(Request $request, Recomendacion $recomendacion)
    {
       $recomendacion->update([
    'institucion_id' => $request->institucion_id,
    'recomendacion' => $request->recomendacion,
    'tipo' => $request->tipo,
    'hallazgo' => $request->hallazgo,
    'prioridad' => $request->prioridad,
    'responsable' => $request->responsable,
    'fecha_cumplimiento' => $request->fecha_cumplimiento,
    'estado' => $request->estado,
]);

        $recomendacion->update($request->all());

        return redirect()
            ->route('recomendaciones.index')
            ->with('success', 'Recomendación actualizada correctamente.');
    }

    /**
     * Eliminar
     */
    public function destroy(Recomendacion $recomendacion)
    {
        $recomendacion->delete();

        return redirect()
            ->route('recomendaciones.index')
            ->with('success', 'Recomendación eliminada correctamente.');
    }
}