<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habito_morbido extends Model
{
    public function habito()
    {
        return $this->belongsTo('App\Habito','id_habito','id');
    }
}
