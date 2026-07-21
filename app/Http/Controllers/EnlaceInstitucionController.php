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


$enlace = EnlaceInstitucion::create([

'institucion_id'=>$institucion->id,

'token'=>Str::random(40)

]);


return back()->with(
'exito',
'Enlace generado correctamente'
);


}


}