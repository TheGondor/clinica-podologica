<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento_morbido extends Model
{
    public function medicamento()
    {
        return $this->belongsTo('App\Medicamento','id_medicamento','id');
    }
}
