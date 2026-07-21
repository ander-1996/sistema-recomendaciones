<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnlaceInstitucion extends Model
{

    protected $table = 'enlaces_instituciones';


    protected $fillable = [
        'institucion_id',
        'token',
        'activo'
    ];


    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

}