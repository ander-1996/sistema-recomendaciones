@extends('layouts.app')

@section('titulo', 'Nueva Recomendación')

@section('contenido')

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Registrar Recomendación
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recomendaciones.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="font-semibold">Institución</label>

                <select name="institucion_id" class="w-full mt-2 border rounded-lg p-2" required>

                    <option value="">Seleccione...</option>

                    @foreach($instituciones as $institucion)
                        <option value="{{ $institucion->id }}">
                            {{ $institucion->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label class="font-semibold">Tipo</label>

                <select name="tipo" class="w-full mt-2 border rounded-lg p-2" required>

                    <option>Curricular</option>
                    <option>Académica</option>
                    <option>Gestión</option>
                    <option>Bienestar</option>
                    <option>Evaluación</option>
                    <option>Permanencia</option>

                </select>
            </div>

            <div class="col-span-2">

                <label class="font-semibold">
                    Recomendación emitida
                </label>

                <textarea
                    name="recomendacion"
                    rows="4"
                    class="w-full mt-2 border rounded-lg p-2"
                    required></textarea>

            </div>

            <div class="col-span-2">

                <label class="font-semibold">
                    Hallazgo o necesidad identificada
                </label>

                <textarea
                    name="hallazgo"
                    rows="4"
                    class="w-full mt-2 border rounded-lg p-2"
                    required></textarea>

            </div>

            <div>

                <label class="font-semibold">
                    Prioridad
                </label>

                <select name="prioridad" class="w-full mt-2 border rounded-lg p-2">

                    <option>Alta</option>
                    <option>Media</option>
                    <option>Baja</option>

                </select>

            </div>

            <div>

                <label class="font-semibold">
                    Responsable
                </label>

                <input
                    type="text"
                    name="responsable"
                    class="w-full mt-2 border rounded-lg p-2">

            </div>


            <div>

                <label class="font-semibold">
                    Fecha cumplimiento
                </label>

                <input
                    type="date"
                    name="fecha_cumplimiento"
                    class="w-full mt-2 border rounded-lg p-2"
                    required>

            </div>

            <div>

                <label class="font-semibold">
                    Estado
                </label>

                <select
                    name="estado"
                    class="w-full mt-2 border rounded-lg p-2">

                    <option>Pendiente</option>
                    <option>En proceso</option>
                    <option>Cumplida</option>
                    <option>Vencida</option>

                </select>

            </div>

        </div>

        <div class="mt-8 flex justify-end gap-3">

            <a
                href="{{ route('recomendaciones.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">

                Cancelar

            </a>

            <button
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">

                Guardar recomendación

            </button>

        </div>

    </form>

</div>

@endsection