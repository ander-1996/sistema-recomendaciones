<?php

namespace App\Http\Controllers;

use App\Models\EnlaceInstitucion;

class PortalInstitucionController extends Controller
{

    public function index($token)
    {

        $enlace = EnlaceInstitucion::with('institucion')
            ->where('token', $token)
            ->where('activo', true)
            ->firstOrFail();


        $institucion = $enlace->institucion;


        $recomendaciones = $institucion
            ->recomendaciones()
            ->orderBy('created_at','desc')
            ->get();


        return view(
            'portal.institucion',
            compact(
                'institucion',
                'recomendaciones'
            )
        );

    }

}