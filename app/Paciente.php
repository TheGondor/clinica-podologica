<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    public function commune()
    {
        return $this->belongsTo('\App\Commune','id_commune','id');
    }

    public function estado()
    {
        return $this->belongsTo('\App\Estado','id_estado','id');
    }

    public function actividad()
    {
        return $this->belongsTo('\App\Actividad','id_actividad','id');
    }

    public function enfermedades()
    {
        return $this->belongsToMany('App\Enfermedad', 'enfermedad_morbidos', 'id_paciente', 'id_enfermedad');
    }

    public function medicamentos()
    {
        return $this->belongsToMany('App\Medicamento', 'medicamento_morbidos', 'id_paciente', 'id_medicamento');
    }

    public function habitos()
    {
        return $this->belongsToMany('App\Habito', 'habito_morbidos', 'id_paciente', 'id_habito');
    }

    public function patologias()
    {
        return $this->belongsToMany('App\Patologia', 'patologia_morbidos', 'id_paciente', 'id_patologia');
    }
}
