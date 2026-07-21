<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $instituciones = Institucion::orderBy('nombre')->paginate(10);

    return view('instituciones.index', compact('instituciones'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('instituciones.create');
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|max:255|unique:institucions,nombre',
        'municipio' => 'required|max:255',
    ]);

    Institucion::create([
        'nombre' => $request->nombre,
        'municipio' => $request->municipio,
    ]);

    return redirect()
        ->route('instituciones.index')
        ->with('success', 'Institución creada correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Institucion $institucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Institucion $institucion)
{
    $institucion->load('usuarios');

    return view('instituciones.edit', compact('institucion'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Institucion $institucion)
{
    $request->validate([
        'nombre' => 'required|max:255',
        'municipio' => 'required|max:255',
    ]);

    $institucion->update([
        'nombre' => $request->nombre,
        'municipio' => $request->municipio,
    ]);

    return redirect()
        ->route('instituciones.index')
        ->with('success', 'Institución actualizada correctamente.');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Institucion $institucion)
{
    $institucion->delete();

    return redirect()
        ->route('instituciones.index')
        ->with('success', 'Institución eliminada correctamente.');
}

}
