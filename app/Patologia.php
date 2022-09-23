<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    public function protocolo()
    {
        return $this->hasOne('App\Protocolo','id_protocolo','id');
    }
}
