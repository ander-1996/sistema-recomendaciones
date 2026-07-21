<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recomendacion extends Model
{
    protected $table = 'recomendaciones';

protected $fillable = [

    'codigo',
    'institucion_id',
    'institucion_origen',
    'recomendacion',
    'tipo',
    'hallazgo',
    'prioridad',
    'responsable',
    'fecha_inicio',
    'fecha_cumplimiento',
    'estado',
    'nombre_contacto',
'cargo_contacto',
'correo_contacto',
'telefono_contacto'


];


    public function seguimientos(): HasMany
{
    return $this->hasMany(Seguimiento::class);
}

public function instituciones()
{
    return $this->belongsToMany(
        Institucion::class,
        'institucion_recomendacion',
        'recomendacion_id',
        'institucion_id'
    );
}

public function institucion(): BelongsTo
{
    return $this->belongsTo(Institucion::class);
}

}

