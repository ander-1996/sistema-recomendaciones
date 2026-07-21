<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de recomendación</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10">

    <div class="bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-3xl font-bold text-green-700 mb-6">
            Consulta de recomendación
        </h1>

        <div class="grid grid-cols-2 gap-6">

            <div>
                <strong>Código</strong><br>
                {{ $recomendacion->codigo }}
            </div>

            <div>
                <strong>Estado</strong><br>
                {{ $recomendacion->estado }}
            </div>

            <div>
                <strong>Institución</strong><br>
                {{ $recomendacion->institucion->nombre }}
            </div>

            <div>
                <strong>Contacto</strong><br>
                {{ $recomendacion->nombre_contacto }}
            </div>

        </div>

        <hr class="my-6">

        <h2 class="text-xl font-bold mb-2">
            Recomendación
        </h2>

        <p>
            {{ $recomendacion->recomendacion }}
        </p>

        <hr class="my-6">

        <h2 class="text-xl font-bold mb-2">
            Historial de seguimiento
        </h2>

        @forelse($recomendacion->seguimientos as $seguimiento)

            <div class="border rounded-lg p-4 mb-4">

                <strong>Fecha:</strong>
                {{ \Carbon\Carbon::parse($seguimiento->fecha)->format('d/m/Y') }}

                <br>

                <strong>Estado:</strong>
                {{ $seguimiento->estado }}

                <br>

                <strong>Avance:</strong>
                {{ $seguimiento->porcentaje }}%

                <br><br>

                {{ $seguimiento->observacion }}

            </div>

        @empty

            <p class="text-gray-500">
                Aún no existen seguimientos registrados.
            </p>

        @endforelse

    </div>

</div>

</body>
</html>