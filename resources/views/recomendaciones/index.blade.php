@extends('layouts.app')

@section('titulo','Recomendaciones')

@section('contenido')

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Recomendaciones
        </h1>

        <p class="text-gray-500">
            Gestión de recomendaciones.
        </p>

    </div>


</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-4 rounded mb-4">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-green-700 text-white">

<div class="bg-white rounded-xl shadow p-5 mb-6">

    <form method="GET">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div>
                <label class="block font-semibold mb-2">
                    Código
                </label>

                <input
                    type="text"
                    name="codigo"
                    value="{{ request('codigo') }}"
                    placeholder="REC-0001"
                    class="w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="block font-semibold mb-2">
                    Institución
                </label>

                <select
                    name="institucion_id"
                    class="w-full border rounded-lg p-2">

                    <option value="">
                        Todas las instituciones
                    </option>

                    @foreach($instituciones as $institucion)

                        <option
                            value="{{ $institucion->id }}"
                            {{ request('institucion_id') == $institucion->id ? 'selected' : '' }}>

                            {{ $institucion->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="flex items-end gap-2">

                <button
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">

                    Buscar

                </button>

                <a
                    href="{{ route('recomendaciones.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">

                    Limpiar

                </a>

            </div>

        </div>

    </form>

</div>

<tr>

<th class="p-3">Código</th>
<th>Institución que recomienda</th>
<th>Institución responsable</th>
<th>Tipo</th>
<th>Prioridad</th>
<th>Estado</th>
<th>Fecha registro</th>
<th>Fecha cumplimiento</th>
<th>Acciones</th>

</tr>

</thead>

<tbody>

@forelse($recomendaciones as $r)

<tr class="border-b">

<td class="p-3">{{ $r->codigo }}</td>

<td>
    {{ $r->institucion_origen }}
</td>

<td>
    {{ optional($r->institucion)->nombre ?? 'Sin asignar' }}
</td>

<td>{{ $r->tipo }}</td>

<td>{{ $r->prioridad }}</td>

<td>{{ $r->estado }}</td>

<td>
    {{ \Carbon\Carbon::parse($r->fecha_inicio)->format('d/m/Y') }}
</td>

<td>
    {{ \Carbon\Carbon::parse($r->fecha_cumplimiento)->format('d/m/Y') }}
</td>

<td>

<a href="{{ route('seguimientos.show', $r) }}"
class="text-green-700 font-semibold">

Seguimiento

</a>

<a href="{{ route('reportes.pdf',$r->id) }}"
class="bg-red-600 text-white px-3 py-2 rounded">

📄 PDF

</a>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="p-5 text-center">

No existen recomendaciones.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-5">

{{ $recomendaciones->links() }}

</div>

@endsection