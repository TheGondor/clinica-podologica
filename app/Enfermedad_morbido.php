<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad_morbido extends Model
{
    public function enfermedad()
    {
        return $this->belongsTo('App\Enfermedad','id_enfermedad','id');
    }
}
