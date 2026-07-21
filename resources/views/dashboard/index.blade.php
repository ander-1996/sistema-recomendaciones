@extends('layouts.app')

@section('titulo','Dashboard')

@section('contenido')

<div class="grid grid-cols-5 gap-6">

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-gray-500">Total</h3>

        <p class="text-4xl font-bold text-green-700 mt-2">

            0

        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-gray-500">

            Cumplidas

        </h3>

        <p class="text-4xl font-bold text-green-600 mt-2">

            0

        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-gray-500">

            En proceso

        </h3>

        <p class="text-4xl font-bold text-yellow-500 mt-2">

            0

        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-gray-500">

            Vencidas

        </h3>

        <p class="text-4xl font-bold text-red-600 mt-2">

            0

        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-gray-500">

            Cumplimiento

        </h3>

        <p class="text-4xl font-bold text-blue-600 mt-2">

            0%

        </p>

    </div>

</div>

<div class="mt-8 bg-white rounded-xl shadow p-6">

    <h3 class="text-xl font-bold text-gray-700 mb-4">

        Avance de las recomendaciones

    </h3>

    <canvas id="graficaCumplimiento" height="100"></canvas>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('graficaCumplimiento');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Institución A',
                'Institución B',
                'Institución C',
                'Institución D'
            ],

            datasets: [{

                label: 'Cumplimiento (%)',

                data: [85, 60, 95, 40],

                borderWidth: 1

            }]

        },

        options: {

            responsive: true,

            scales: {

                y: {

                    beginAtZero: true,

                    max: 100

                }

            }

        }

    });

});

</script>

@endpush