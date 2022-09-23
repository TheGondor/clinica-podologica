<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patologia_morbido extends Model
{
    public function patologia()
    {
        return $this->belongsTo('App\Patologia','id_patologia','id');
    }
}
