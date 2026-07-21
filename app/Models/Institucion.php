<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institucion extends Model
{
    protected $fillable = [
        'nombre',
        'municipio',
    ];

 public function usuarios()
{
    return $this->hasMany(User::class);
}

 public function recomendaciones()
{
    return $this->belongsToMany(
        Recomendacion::class,
        'institucion_recomendacion',
        'institucion_id',
        'recomendacion_id'
    );
}

public function enlaces()
{
    return $this->hasMany(EnlaceInstitucion::class);
}
}