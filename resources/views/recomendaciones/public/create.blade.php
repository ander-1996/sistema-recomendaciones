<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Recomendación</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">

    <h1 class="text-3xl font-bold text-green-700 mb-6">
        Formulario de Recomendaciones
    </h1>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Se encontraron los siguientes errores:</strong>
        <ul class="list-disc ml-5 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-5">
        {{ session('success') }}
    </div>
@endif

@if(session('link_consulta'))

<div class="bg-blue-100 border border-blue-300 text-blue-800 p-4 rounded-lg mb-5">

    <h3 class="font-bold text-lg">
        ✅ Guarde este enlace para consultar el estado de su recomendación
    </h3>

    <p class="mt-2">
        Puede ingresar en cualquier momento para conocer el historial de seguimiento.
    </p>

    <a href="{{ session('link_consulta') }}"
       target="_blank"
       class="mt-3 inline-block text-blue-700 underline break-all">

        {{ session('link_consulta') }}

    </a>

</div>

@endif


    <form action="{{ route('recomendacion.public.store') }}" method="POST">
        @csrf


        <div class="mb-4">
            <label class="block font-semibold">
                
            Institución que hace la recomendación
            </label>

            <select name="institucion_origen"
        class="w-full border rounded p-2">

<option value="">
Seleccione institución que recomienda
</option>

<option>Alcaldía de Manizales</option>
<option>American Business School</option>
<option>CHEC</option>
<option>Gobernación de Caldas</option>
<option>Universidad Autónoma de Manizales</option>
<option>Universidad Católica de Manizales</option>
<option>Universidad de Caldas</option>
<option>Universidad de Manizales</option>
<option>UNIOC</option>
<option>Universidad Tecnológica de Pereira</option>
<option>Universidad Minuto de Dios</option>
<option>Universidad Luis Amigo</option>
<option>UNAD</option>

</select>
        </div>



        <div class="mb-4">
            <label class="block font-semibold">
                Nombre de quien realiza la recomendación
            </label>

            <input type="text"
                   name="nombre_contacto"
                   class="w-full border rounded p-2">
        </div>


        <div class="mb-4">
            <label class="block font-semibold">
                Cargo
            </label>

            <input type="text"
                   name="cargo_contacto"
                   class="w-full border rounded p-2">
        </div>


        <div class="mb-4">
            <label class="block font-semibold">
                Correo electrónico
            </label>

            <input type="email"
                   name="correo_contacto"
                   class="w-full border rounded p-2">
        </div>


        <div class="mb-4">
            <label class="block font-semibold">
                Teléfono
            </label>

            <input type="text"
                   name="telefono_contacto"
                   class="w-full border rounded p-2">
        </div>



        <div class="mb-4">
            <label class="block font-semibold">
                Recomendación emitida
            </label>

            <textarea name="titulo"
                      class="w-full border rounded p-2"></textarea>
        </div>

        
        <div class="mb-4">

            <label class="block font-semibold">
                Hallazgo o necesidad identificada
            </label>

            <textarea name="hallazgo"
                      class="w-full border rounded p-2"></textarea>

        </div>


        <div class="mb-4">

            <label class="block font-semibold">
                Tipo
            </label>


            <select name="tipo"
                    class="w-full border rounded p-2">

                <option>Curricular</option>
                <option>Académica</option>
                <option>Gestión</option>
                <option>Bienestar</option>
                <option>Evaluación</option>
                <option>Permanencia</option>

            </select>

        </div>



        <div class="mb-4">

            <label class="block font-semibold">
                Prioridad
            </label>


            <select name="prioridad"
                    class="w-full border rounded p-2">

                <option>Alta</option>
                <option>Media</option>
                <option>Baja</option>

            </select>

        </div>






     <div class="mb-4">

<div class="mb-4">

    <label class="block font-semibold">
        Institución responsable de atender la recomendación
    </label>

    <select
        name="institucion_id"
        class="w-full border rounded p-2"
        required>

        <option value="">
            Seleccione una institución
        </option>

        @foreach($instituciones as $institucion)

            <option value="{{ $institucion->id }}">
                {{ $institucion->nombre }}
            </option>

        @endforeach

    </select>

</div>


</div>

        <div class="mb-4">

    <label class="block font-semibold">
        Fecha estimada de cumplimiento
    </label>

    <input 
        type="date"
        name="fecha_cumplimiento"
        class="w-full border rounded p-2"
        required>

</div>



        <button class="bg-green-700 text-white px-6 py-3 rounded hover:bg-green-800">
            Registrar recomendación
        </button>


    </form>

</div>

</body>
</html>