<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Seguimiento de Recomendaciones</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-800 text-white shadow-xl">

        <div class="p-6 border-b border-green-700">

            <h1 class="text-xl font-bold">
                ☕ RECOMENDACIONES
            </h1>

            <p class="text-sm text-green-200 mt-1">
                Seguimiento a recomendaciones
            </p>

        </div>

      <nav class="mt-6">

    <a href="{{ route('dashboard') }}"
        class="flex items-center px-6 py-3 hover:bg-green-700 transition rounded-r-full">

        <span class="mr-3">🏠</span>
        Dashboard

    </a>

    <a href="{{ route('instituciones.index') }}"
        class="flex items-center px-6 py-3 hover:bg-green-700 transition rounded-r-full">

        <span class="mr-3">🏫</span>
        Instituciones

    </a>

     <a href="{{ route('recomendaciones.index') }}"
        class="flex items-center px-6 py-3 hover:bg-green-700 transition rounded-r-full">

        <span class="mr-3">📝</span>
        Recomendaciones

    </a>

    <a href="{{ route('reportes.index') }}"
        class="flex items-center px-6 py-3 hover:bg-green-700 transition rounded-r-full">

        <span class="mr-3">📊</span>
        Reportes

    </a>

</nav>

    </aside>

    <!-- Contenido -->
    <main class="flex-1">

        <header class="bg-white shadow px-8 py-4 flex justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">

                    @yield('titulo')

                </h2>

            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                    Cerrar sesión

                </button>

            </form>

        </header>

        <div class="p-8">

            @yield('contenido')

        </div>

    </main>

</div>

@stack('scripts')

</body>
</html>