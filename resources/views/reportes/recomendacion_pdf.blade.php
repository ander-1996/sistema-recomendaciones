<!DOCTYPE html>
<html>
<head>

<title>
Reporte Recomendación
</title>

<style>

body{
    font-family: Arial, sans-serif;
    font-size:14px;
}

.titulo{
    text-align:center;
    font-size:22px;
    font-weight:bold;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

td,th{
    border:1px solid #ccc;
    padding:8px;
}

th{
    background:#eee;
}

</style>

</head>


<body>


<div class="titulo">
Sistema de Seguimiento de Recomendaciones
</div>


<table>

<tr>
<th>Código</th>
<td>
{{ $recomendacion->codigo }}
</td>
</tr>


<tr>
<th>Institución</th>
<td>
{{ $recomendacion->institucion->nombre }}
</td>
</tr>


<tr>
<th>Recomendación</th>
<td>
{{ $recomendacion->recomendacion }}
</td>
</tr>


<tr>
<th>Hallazgo</th>
<td>
{{ $recomendacion->hallazgo }}
</td>
</tr>


<tr>
<th>Tipo</th>
<td>
{{ $recomendacion->tipo }}
</td>
</tr>


<tr>
<th>Prioridad</th>
<td>
{{ $recomendacion->prioridad }}
</td>
</tr>


<tr>
<th>Responsable</th>
<td>
{{ $recomendacion->responsable }}
</td>
</tr>


<tr>
<th>Estado</th>
<td>
{{ $recomendacion->estado }}
</td>
</tr>


<tr>
<th>Fecha cumplimiento</th>
<td>
{{ $recomendacion->fecha_cumplimiento }}
</td>
</tr>


</table>


<h3>
Seguimientos
</h3>


<table>

<tr>
<th>Fecha</th>
<th>Usuario</th>
<th>Observación</th>
<th>%</th>
</tr>


@foreach($recomendacion->seguimientos as $seguimiento)

<tr>

<td>
{{ $seguimiento->fecha }}
</td>


<td>
{{ $seguimiento->usuario->name ?? '' }}
</td>


<td>
{{ $seguimiento->observacion }}
</td>


<td>
{{ $seguimiento->porcentaje }}%
</td>


</tr>

@endforeach


</table>


</body>

</html>