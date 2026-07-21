@extends('layouts.app')

@section('titulo', 'Editar Recomendación')

@section('contenido')

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Editar Recomendación
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

    <form action="{{ route('recomendaciones.update', $recomendacion) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="font-semibold">Institución</label>

                <select name="institucion_id" class="w-full mt-2 border rounded-lg p-2" required>

                    @foreach($instituciones as $institucion)

                        <option value="{{ $institucion->id }}"
                            {{ old('institucion_id', $recomendacion->institucion_id) == $institucion->id ? 'selected' : '' }}>

                            {{ $institucion->nombre }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>
                <label class="font-semibold">Tipo</label>

                <select name="tipo" class="w-full mt-2 border rounded-lg p-2" required>

                    <option value="Curricular" {{ old('tipo', $recomendacion->tipo) == 'Curricular' ? 'selected' : '' }}>
                        Curricular
                    </option>

                    <option value="Académica" {{ old('tipo', $recomendacion->tipo) == 'Académica' ? 'selected' : '' }}>
                        Académica
                    </option>

                    <option value="Gestión" {{ old('tipo', $recomendacion->tipo) == 'Gestión' ? 'selected' : '' }}>
                        Gestión
                    </option>

                    <option value="Bienestar" {{ old('tipo', $recomendacion->tipo) == 'Bienestar' ? 'selected' : '' }}>
                        Bienestar
                    </option>

                    <option value="Evaluación" {{ old('tipo', $recomendacion->tipo) == 'Evaluación' ? 'selected' : '' }}>
                        Evaluación
                    </option>

                    <option value="Permanencia" {{ old('tipo', $recomendacion->tipo) == 'Permanencia' ? 'selected' : '' }}>
                        Permanencia
                    </option>

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
                    required>{{ old('recomendacion', $recomendacion->recomendacion) }}</textarea>

            </div>

            <div class="col-span-2">

                <label class="font-semibold">
                    Hallazgo o necesidad identificada
                </label>

                <textarea
                    name="hallazgo"
                    rows="4"
                    class="w-full mt-2 border rounded-lg p-2"
                    required>{{ old('hallazgo', $recomendacion->hallazgo) }}</textarea>

            </div>

            <div>

                <label class="font-semibold">
                    Prioridad
                </label>

                <select name="prioridad" class="w-full mt-2 border rounded-lg p-2">

                    <option value="Alta" {{ old('prioridad', $recomendacion->prioridad) == 'Alta' ? 'selected' : '' }}>
                        Alta
                    </option>

                    <option value="Media" {{ old('prioridad', $recomendacion->prioridad) == 'Media' ? 'selected' : '' }}>
                        Media
                    </option>

                    <option value="Baja" {{ old('prioridad', $recomendacion->prioridad) == 'Baja' ? 'selected' : '' }}>
                        Baja
                    </option>

                </select>

            </div>

            <div>

                <label class="font-semibold">
                    Responsable
                </label>

                <input
                    type="text"
                    name="responsable"
                    value="{{ old('responsable', $recomendacion->responsable) }}"
                    class="w-full mt-2 border rounded-lg p-2">

            </div>

 

            <div>

                <label class="font-semibold">
                    Fecha cumplimiento
                </label>

                <input
                    type="date"
                    name="fecha_cumplimiento"
                    value="{{ old('fecha_cumplimiento', $recomendacion->fecha_cumplimiento) }}"
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

                    <option value="Pendiente" {{ old('estado', $recomendacion->estado) == 'Pendiente' ? 'selected' : '' }}>
                        Pendiente
                    </option>

                    <option value="En proceso" {{ old('estado', $recomendacion->estado) == 'En proceso' ? 'selected' : '' }}>
                        En proceso
                    </option>

                    <option value="Cumplida" {{ old('estado', $recomendacion->estado) == 'Cumplida' ? 'selected' : '' }}>
                        Cumplida
                    </option>

                    <option value="Vencida" {{ old('estado', $recomendacion->estado) == 'Vencida' ? 'selected' : '' }}>
                        Vencida
                    </option>

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
                type="submit"
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">

                Actualizar recomendación

            </button>

        </div>

    </form>

</div>

@endsection