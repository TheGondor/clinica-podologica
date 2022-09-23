<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public function Medicamento_paciente()
    {
        return $this->HasMany('\App\Medicamento_paciente','id','id_medicamento');
    }

    public function tipo_medicamento()
    {
        return $this->belongsTo('\App\Tipo_medicamento','id_tipo_medicamento','id');
    }

    public function morbido()
    {
        return $this->belongsTo('App\Paciente','id_paciente','id');
    }
}
