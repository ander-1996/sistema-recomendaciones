<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seguimiento extends Model
{
    protected $fillable = [
        'recomendacion_id',
        'user_id',
        'fecha',
        'estado',
        'porcentaje',
        'observacion',
        'compromisos',
        'evidencia',
    ];

    public function recomendacion(): BelongsTo
    {
        return $this->belongsTo(Recomendacion::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}