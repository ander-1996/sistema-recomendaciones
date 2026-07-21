@extends('layouts.app')

@section('titulo', 'Instituciones')

@section('contenido')

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-lg p-6">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-bold text-gray-800">
            Instituciones
        </h2>

        <a href="{{ route('instituciones.create') }}"
           class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg">
            + Nueva institución
        </a>

    </div>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-gray-100">

                <th class="text-left p-3">Nombre</th>
                <th class="text-left p-3">Municipio</th>
                <th class="text-center p-3">Acciones</th>

            </tr>

        </thead>

        <tbody>

            @forelse($instituciones as $institucion)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">{{ $institucion->nombre }}</td>

                    <td class="p-3">{{ $institucion->municipio }}</td>

                   <td class="px-6 py-4 whitespace-nowrap text-sm flex gap-3">

                   <a href="{{ route('crear.enlace',$institucion->id) }}"
class="btn btn-success">

Generar enlace público

</a>

 <a href="{{ route('instituciones.edit', $institucion) }}"
   class="text-blue-600 hover:text-blue-800 font-semibold">
    Editar
</a>

   <form action="{{ route('instituciones.destroy', $institucion) }}"
      method="POST"
      onsubmit="return confirm('¿Desea eliminar esta institución?')">

    @csrf
    @method('DELETE')

    <button type="submit"
        class="text-red-600 hover:text-red-800 font-semibold">
        Eliminar
    </button>

</form>

</td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="text-center p-6 text-gray-500">
                        No hay instituciones registradas.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="mt-6">
        {{ $instituciones->links() }}
    </div>

</div>

@endsection