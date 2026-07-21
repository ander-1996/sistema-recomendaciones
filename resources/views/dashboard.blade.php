@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')

<div class="space-y-8">

    <!-- Título -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Sistema de Seguimiento de Recomendaciones
            </h1>

         

        </div>

    </div>

    <!-- Tarjetas -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Total -->

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-600">

            <p class="text-gray-500">
                Total recomendaciones
            </p>

            <h2 class="text-4xl font-bold mt-3 text-blue-700">
                {{ $totalRecomendaciones }}
            </h2>

        </div>

        <!-- Cumplidas -->

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-600">

            <p class="text-gray-500">
                Cumplidas
            </p>

            <h2 class="text-4xl font-bold mt-3 text-green-700">
                {{ $cumplidas }}
            </h2>

        </div>

        <!-- En proceso -->

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">

            <p class="text-gray-500">
                En proceso
            </p>

            <h2 class="text-4xl font-bold mt-3 text-yellow-600">
                {{ $enProceso }}
            </h2>

        </div>

        <!-- Vencidas -->

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-600">

            <p class="text-gray-500">
                Vencidas
            </p>

            <h2 class="text-4xl font-bold mt-3 text-red-600">
                {{ $vencidas }}
            </h2>

        </div>

    </div>

    <!-- Barra de cumplimiento -->

    <div class="bg-white rounded-xl shadow-lg p-6">

        <div class="flex justify-between mb-3">

            <h2 class="text-xl font-bold">

                Cumplimiento General

            </h2>

            <span class="font-bold text-green-700">

                {{ $porcentajeGeneral }}%

            </span>

        </div>

        <div class="w-full bg-gray-200 rounded-full h-6">

            <div
                class="bg-green-600 h-6 rounded-full text-white text-sm text-center leading-6"
                style="width: {{ $porcentajeGeneral }}%">

                {{ $porcentajeGeneral }}%

            </div>

        </div>

    </div>

    <!-- Alertas de vencimiento -->

    @if($proximasAVencer->count() > 0)

    <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl shadow-lg p-6">

        <div class="flex items-center mb-4">

            <h2 class="text-xl font-bold text-yellow-700">
                ⚠️ Atención
            </h2>

        </div>


        <p class="text-gray-700 mb-5">

            Existen 
            <strong>{{ $proximasAVencer->count() }}</strong>
            recomendaciones que vencen en los próximos 7 días.

        </p>


        <div class="space-y-4">


            @foreach($proximasAVencer as $recomendacion)


            <div class="bg-white rounded-lg p-4 shadow flex justify-between items-center">


                <div>

                    <p class="font-bold text-gray-800">

                        {{ $recomendacion->codigo }}

                    </p>


                    <p class="text-gray-600">

                        Institución:
                        {{ $recomendacion->institucion->nombre ?? 'Sin institución' }}

                    </p>


                </div>


                <div class="text-right">


                    <p class="text-sm text-gray-500">

                        Vence:

                    </p>


                    <p class="font-bold text-red-600">

                        {{ \Carbon\Carbon::parse($recomendacion->fecha_cumplimiento)->format('d/m/Y') }}

                    </p>


                </div>


            </div>


            @endforeach


        </div>


    </div>

    @endif

        <!-- Estadísticas -->

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Resumen -->

        <div class="bg-white rounded-xl shadow-lg p-6">

            <h2 class="text-xl font-bold mb-6">
                Resumen de estados
            </h2>

            <div class="space-y-5">

                <div class="flex justify-between items-center">

                    <span class="text-gray-700">
                        Pendientes
                    </span>

                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg font-bold">
                        {{ $pendientes }}
                    </span>

                </div>

                <div class="flex justify-between items-center">

                    <span class="text-gray-700">
                        En proceso
                    </span>

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg font-bold">
                        {{ $enProceso }}
                    </span>

                </div>

                <div class="flex justify-between items-center">

                    <span class="text-gray-700">
                        Cumplidas
                    </span>

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-bold">
                        {{ $cumplidas }}
                    </span>

                </div>

                <div class="flex justify-between items-center">

                    <span class="text-gray-700">
                        Vencidas
                    </span>

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-lg font-bold">
                        {{ $vencidas }}
                    </span>

                </div>

            </div>

        </div>

        <!-- Información general -->

        <div class="bg-white rounded-xl shadow-lg p-6">

            <h2 class="text-xl font-bold mb-6">
                Información General
            </h2>

            <div class="space-y-5">

                <div class="flex justify-between">

                    <span>Instituciones</span>

                    <span class="font-bold">
                        {{ $instituciones }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span>Usuarios</span>

                    <span class="font-bold">
                        {{ $usuarios }}
                    </span>

                </div>

                <div class="flex justify-between">

                    <span>Total recomendaciones</span>

                    <span class="font-bold">
                        {{ $totalRecomendaciones }}
                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- Últimos seguimientos -->

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h2 class="text-xl font-bold mb-6">
            Últimos seguimientos registrados
        </h2>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>

                    <tr class="border-b bg-gray-100">

                        <th class="text-left p-3">Código</th>
                        <th class="text-left p-3">Usuario</th>
                        <th class="text-left p-3">Estado</th>
                        <th class="text-left p-3">% Avance</th>
                        <th class="text-left p-3">Fecha</th>

                    </tr>

                </thead>

                <tbody>

                                    @forelse($ultimosSeguimientos as $seguimiento)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3 font-semibold">
                                {{ $seguimiento->recomendacion->codigo ?? 'N/A' }}
                            </td>

                            <td class="p-3">
                                {{ $seguimiento->usuario->name }}
                            </td>

                            <td class="p-3">

                                @if($seguimiento->estado == 'Cumplida')

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        {{ $seguimiento->estado }}
                                    </span>

                                @elseif($seguimiento->estado == 'En proceso')

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        {{ $seguimiento->estado }}
                                    </span>

                                @elseif($seguimiento->estado == 'Vencida')

                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        {{ $seguimiento->estado }}
                                    </span>

                                @else

                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                        {{ $seguimiento->estado }}
                                    </span>

                                @endif

                            </td>

                            <td class="p-3">
                                {{ $seguimiento->porcentaje }}%
                            </td>

                            <td class="p-3">
                                {{ \Carbon\Carbon::parse($seguimiento->fecha)->format('d/m/Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center text-gray-500 py-8">

                                No existen seguimientos registrados.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection