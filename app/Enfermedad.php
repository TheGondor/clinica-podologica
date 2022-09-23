<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    public function Enfermedad_morbido()
    {
        return $this->HasMany('\App\Enfermedad_morbido','id','id_enfermedad');
    }

    public function tipo_enfermedad()
    {
        return $this->belongsTo('\App\Tipo_enfermedad','id_tipo_enfermedad','id');
    }
}
