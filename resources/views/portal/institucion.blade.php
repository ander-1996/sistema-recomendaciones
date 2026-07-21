<!DOCTYPE html>
<html>

<head>

<title>
Portal Institución
</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


<div class="card">

<div class="card-body">


<h2>
{{ $institucion->nombre }}
</h2>


<p>
Portal de seguimiento de recomendaciones
</p>


<hr>


<h4>
Total recomendaciones:
{{ $recomendaciones->count() }}
</h4>



</div>

</div>



<div class="mt-4">


@foreach($recomendaciones as $recomendacion)


<div class="card mb-3">

<div class="card-body">


<h5>
{{ $recomendacion->codigo }}
</h5>


<p>
{{ $recomendacion->descripcion }}
</p>


<p>
<strong>
Estado:
</strong>

{{ $recomendacion->estado }}

</p>


<a href="#" 
class="btn btn-primary">

Registrar seguimiento

</a>


</div>

</div>


@endforeach


</div>


</div>


</body>

</html>php artisan optimize:clear