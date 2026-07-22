<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\EnlaceInstitucion;
use Illuminate\Support\Str;

class EnlaceInstitucionController extends Controller
{
    public function crear($id)
    {
        $institucion = Institucion::findOrFail($id);

        // Buscar si ya existe un enlace activo
        $enlace = EnlaceInstitucion::where('institucion_id', $institucion->id)
            ->where('activo', true)
            ->first();

        // Si no existe, crearlo
        if (!$enlace) {
            $enlace = EnlaceInstitucion::create([
                'institucion_id' => $institucion->id,
                'token' => Str::random(40),
                'activo' => true,
            ]);
        }

        return response()->json([
            'enlace' => route('portal.institucion', $enlace->token)
        ]);
    }
}