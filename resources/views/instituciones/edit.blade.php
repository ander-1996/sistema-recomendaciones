@extends('layouts.app')

@section('titulo', 'Nueva Institución')

@section('contenido')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">

    <h2 class="text-2xl font-bold mb-8">
        Editar Institución
    </h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 rounded-lg p-4 mb-6">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('instituciones.update', $institucion) }}" method="POST">
    @csrf
    @method('PUT')

        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Nombre
            </label>

            <input
                type="text"
                name="nombre"
                value="{{ old('nombre', $institucion->nombre) }}"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-600"
                >
        </div>

        <div class="mb-8">
            <label class="block font-semibold mb-2">
                Municipio
            </label>

            <input
                type="text"
                name="municipio"
                value="{{ old('municipio', $institucion->municipio) }}"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-green-600"
                >
        </div>

    

        <h3 class="text-lg font-bold mt-8 mb-4">
    Usuario asociado
</h3>



    <div class="flex justify-end gap-3">

            <a href="{{ route('instituciones.index') }}"
               class="px-5 py-3 rounded-lg border border-gray-300 hover:bg-gray-100">
                Cancelar
            </a>

            <button
                type="submit"
                class="bg-green-700 hover:bg-green-800 text-white px-5 py-3 rounded-lg">
                Guardar
            </button>

        </div>

    </form>

</div>

@endsection