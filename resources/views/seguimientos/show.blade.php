@extends('layouts.app')

@section('titulo','Seguimiento de Recomendación')

@section('contenido')

@if(session('success'))
<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded-lg p-6 mb-6">

    <h2 class="text-xl font-bold text-green-700 mb-4">
        Información de quien realiza la recomendación
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

     <div>
    <span class="text-gray-500 text-sm">
        Institución que realiza la recomendación
    </span>

    <p class="font-semibold">
        {{ $recomendacion->institucion_origen }}
    </p>
</div>

        <div>
            <span class="text-gray-500 text-sm">Nombre del contacto</span>
            <p class="font-semibold">
                {{ $recomendacion->nombre_contacto ?: 'No registrado' }}
            </p>
        </div>

        <div>
            <span class="text-gray-500 text-sm">Cargo</span>
            <p class="font-semibold">
                {{ $recomendacion->cargo_contacto ?: 'No registrado' }}
            </p>
        </div>

        <div>
            <span class="text-gray-500 text-sm">Correo electrónico</span>
            <p class="font-semibold">
                {{ $recomendacion->correo_contacto ?: 'No registrado' }}
            </p>
        </div>

        <div>
            <span class="text-gray-500 text-sm">Teléfono</span>
            <p class="font-semibold">
                {{ $recomendacion->telefono_contacto ?: 'No registrado' }}
            </p>
        </div>

        <div>
            <span class="text-gray-500 text-sm">Fecha de registro</span>
            <p class="font-semibold">
                {{ $recomendacion->created_at->format('d/m/Y H:i') }}
            </p>
        </div>

    </div>

</div>

<!-- Información de la recomendación -->

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">

    <h2 class="text-2xl font-bold text-green-700 mb-6">
        {{ $recomendacion->codigo }}
    </h2>

    <div class="grid grid-cols-2 gap-6">

     <div>
    <strong>Institución responsable</strong><br>

    {{ optional($recomendacion->institucion)->nombre ?? 'Sin institución asignada' }}
</div>

        <div>
            <strong>Estado actual</strong><br>
            {{ $recomendacion->estado }}
        </div>

        <div>
    <strong>Avance actual</strong><br>

    @php
        $ultimo = $seguimientos->first();
        $avance = $ultimo ? $ultimo->porcentaje : 0;
    @endphp

    <div class="mt-2">

        <div class="w-full bg-gray-200 rounded-full h-5">

            <div
                class="bg-green-600 h-5 rounded-full text-white text-center text-sm"
                style="width: {{ $avance }}%;">

                @php

if($avance < 30){
    $color = 'bg-red-600';
}elseif($avance < 70){
    $color = 'bg-yellow-500';
}else{
    $color = 'bg-green-600';
}

@endphp

            </div>

        </div>

    </div>

</div>

        <div class="col-span-2">
            <strong>Recomendación</strong><br>
            {{ $recomendacion->recomendacion }}
        </div>

        <div class="col-span-2">
            <strong>Hallazgo</strong><br>
            {{ $recomendacion->hallazgo }}
        </div>


        <div>
            <strong>Prioridad</strong><br>
            {{ $recomendacion->prioridad }}
        </div>

        <div>
            <strong>Fecha registro</strong><br>
            {{ \Carbon\Carbon::parse($recomendacion->fecha_inicio)->format('d/m/Y') }}
        </div>

        <div>
            <strong>Fecha cumplimiento</strong><br>
            {{ \Carbon\Carbon::parse($recomendacion->fecha_cumplimiento)->format('d/m/Y') }}
        </div>

    </div>

</div>

<!-- Nuevo seguimiento -->

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">

    <h2 class="text-xl font-bold mb-6">
        Registrar seguimiento
    </h2>

    <form
        action="{{ route('seguimientos.store',$recomendacion) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">
                    Estado
                </label>

                <select
                    name="estado"
                    class="w-full border rounded-lg p-2">

                    <option>Pendiente</option>
                    <option>En proceso</option>
                    <option>Cumplida</option>
                    <option>Vencida</option>

                </select>

            </div>

            <div>

                <label class="font-semibold">
                    % Cumplimiento
                </label>

                <input
                    type="number"
                    name="porcentaje"
                    min="0"
                    max="100"
                    value="0"
                    class="w-full border rounded-lg p-2">

            </div>

            <div class="col-span-2">

                <label class="font-semibold">
                    Observación
                </label>

                <textarea
                    name="observacion"
                    rows="4"
                    class="w-full border rounded-lg p-2"
                    required></textarea>

            </div>

            <div class="col-span-2">

                <label class="font-semibold">
                    Compromisos
                </label>

                <textarea
                    name="compromisos"
                    rows="4"
                    class="w-full border rounded-lg p-2"></textarea>

            </div>

            <div class="col-span-2">

                <label class="font-semibold">
                    Evidencia
                </label>

                <input
                    type="file"
                    name="evidencia"
                    class="w-full border rounded-lg p-2">

            </div>

        </div>

        <div class="mt-6">

            <button
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg">

                Guardar seguimiento

            </button>

        </div>

    </form>

</div>

<!-- Historial -->

<div class="bg-white rounded-xl shadow-lg p-6">

    <h2 class="text-xl font-bold mb-6">
        Historial de seguimientos
    </h2>

    @forelse($seguimientos as $seguimiento)

        <div class="border rounded-lg p-5 mb-5">

            <div class="grid grid-cols-2 gap-4">

                <div>

                    <strong>Fecha</strong><br>

                    {{ \Carbon\Carbon::parse($seguimiento->fecha)->format('d/m/Y') }}

                </div>

                <div>

                    <strong>Usuario</strong><br>

                    {{ $seguimiento->usuario->name }}

                </div>

                <div>

                    <strong>Estado</strong><br>

                    {{ $seguimiento->estado }}

                </div>

                <div>

                   <div>
    <strong>Porcentaje de cumplimiento</strong><br>

    <div class="mt-2">

        <div class="w-full bg-gray-200 rounded-full h-4">

            <div
                class="bg-green-600 h-4 rounded-full text-xs text-white text-center"
                style="width: {{ $seguimiento->porcentaje }}%;">

                @if($seguimiento->porcentaje > 10)
                    {{ $seguimiento->porcentaje }}%
                @endif

            </div>

        </div>

    </div>

</div>

                </div>

            </div>

            <hr class="my-4">

            <strong>Observación</strong>

            <p class="mt-2">

                {{ $seguimiento->observacion }}

            </p>

            @if($seguimiento->compromisos)

                <strong class="block mt-4">

                    Compromisos

                </strong>

                <p>

                    {{ $seguimiento->compromisos }}

                </p>

            @endif

            @if($seguimiento->evidencia)

                <a
                    href="{{ asset('storage/'.$seguimiento->evidencia) }}"
                    target="_blank"
                    class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                    Ver evidencia

                </a>

            @endif

        </div>

    @empty

        <p class="text-gray-500">

            No existen seguimientos registrados.

        </p>

    @endforelse

</div>

@endsection