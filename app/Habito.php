<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habito extends Model
{
    public function morbido()
    {
        return $this->belongsTo('App\Morbido','id_morbido','id');
    }
}
