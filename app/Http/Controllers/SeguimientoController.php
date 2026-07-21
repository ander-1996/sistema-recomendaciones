<?php

namespace App\Http\Controllers;

use App\Models\Recomendacion;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeguimientoController extends Controller
{
    /**
     * Mostrar la recomendación y su historial.
     */
public function show(Recomendacion $recomendacion)
{
    $recomendacion->load('instituciones');

    $seguimientos = Seguimiento::where('recomendacion_id', $recomendacion->id)
        ->with('usuario')
        ->latest()
        ->get();

    return view('seguimientos.show', compact(
        'recomendacion',
        'seguimientos'
    ));
}
    /**
     * Guardar un seguimiento.
     */
    public function store(Request $request, Recomendacion $recomendacion)
    {
        $request->validate([
            'estado' => 'required',
            'porcentaje' => 'required|integer|min:0|max:100',
            'observacion' => 'required',
            'compromisos' => 'nullable',
            'evidencia' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        $archivo = null;

        if ($request->hasFile('evidencia')) {

            $archivo = $request->file('evidencia')
                ->store('evidencias', 'public');

        }

        Seguimiento::create([

            'recomendacion_id' => $recomendacion->id,

            'user_id' => Auth::id(),

            'fecha' => now()->toDateString(),

            'estado' => $request->estado,

            'porcentaje' => $request->porcentaje,

            'observacion' => $request->observacion,

            'compromisos' => $request->compromisos,

            'evidencia' => $archivo,

        ]);

        // Actualiza el estado de la recomendación
        $recomendacion->update([
            'estado' => $request->estado
        ]);

        return back()->with(
            'success',
            'Seguimiento registrado correctamente.'
        );
    }
}