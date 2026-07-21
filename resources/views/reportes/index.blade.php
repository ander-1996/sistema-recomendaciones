@extends('layouts.app')

@section('titulo','Reportes')

@section('contenido')

<div class="space-y-8">


<h1 class="text-3xl font-bold text-gray-800">
    Reportes Ejecutivos
</h1>

<a href="{{ route('reportes.excel') }}"
class="inline-block bg-green-700 text-white px-5 py-3 rounded-lg hover:bg-green-800">

📥 Descargar Excel

</a>

<!-- Tarjetas -->

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">


<div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-blue-600">

<p class="text-gray-500">
Total recomendaciones
</p>

<h2 class="text-4xl font-bold text-blue-700">
{{ $total }}
</h2>

</div>



<div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-600">

<p class="text-gray-500">
Cumplidas
</p>

<h2 class="text-4xl font-bold text-green-700">
{{ $cumplidas }}
</h2>

</div>



<div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-yellow-500">

<p class="text-gray-500">
En proceso
</p>

<h2 class="text-4xl font-bold text-yellow-600">
{{ $enProceso }}
</h2>

</div>



<div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-600">

<p class="text-gray-500">
Vencidas
</p>

<h2 class="text-4xl font-bold text-red-600">
{{ $vencidas }}
</h2>

</div>


</div>



<!-- Gráficas -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">


<!-- Estado -->

<div class="bg-white rounded-xl shadow-lg p-6">

<h2 class="text-xl font-bold mb-5">
Recomendaciones por estado
</h2>

<canvas id="estadoChart"></canvas>

</div>



<!-- Institución -->

<div class="bg-white rounded-xl shadow-lg p-6">

<h2 class="text-xl font-bold mb-5">
Recomendaciones por institución
</h2>

<canvas id="institucionChart"></canvas>

</div>


</div>


</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


const estadoChart = new Chart(
document.getElementById('estadoChart'),
{

type:'doughnut',

data:{

labels:@json(array_keys($porEstado)),

datasets:[{

data:@json(array_values($porEstado))

}]

},

options:{

responsive:true

}

}

);




const institucionChart = new Chart(
document.getElementById('institucionChart'),
{

type:'bar',

data:{

labels:@json($porInstitucion->pluck('nombre')),

datasets:[{

label:'Recomendaciones',

data:@json($porInstitucion->pluck('total'))

}]

},

options:{

responsive:true

}

}

);


</script>


@endsection