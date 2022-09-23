@extends('layouts.app')

@section('content')
<input type="hidden" id="id_paciente" name="id_paciente" value="{{$personales->id}}">
<div class="container">
    <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#antecedentes_personales" aria-expanded="true" aria-controls="collapseOne">
                Antecedentes Personales
              </button>
            </h5>
          </div>
      
          <div id="antecedentes_personales" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            @include('paciente.personales.datos',compact('personales'))
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#antecedentes_morbidos" aria-expanded="false" aria-controls="collapseTwo">
                Antecedentes Morbidos
              </button>
            </h5>
          </div>
          <div id="antecedentes_morbidos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            @include('paciente.morbidos.datos',compact('morbido','fecha_morbido'))
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#examenes" aria-expanded="false" aria-controls="collapseThree">
                Examen Fisico General
              </button>
            </h5>
          </div>
          <div id="examenes" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            @include('paciente.examen.datos', compact('examen', 'fecha_examen'))
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#pies" aria-expanded="false" aria-controls="collapseThree">
                Pies
              </button>
            </h5>
          </div>
          <div id="pies" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            @include('paciente.examen.pies',compact('pie', 'fecha_pies'))
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#atenciones" id="boton_ver_atenciones" aria-expanded="false" aria-controls="collapseThree">
                Atenciones
              </button>
            </h5>
          </div>
          <div id="atenciones" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            @include('paciente.atencion.datos')
          </div>
        </div>
    </div>
</div>

  @include('paciente.personales.modal_editar', compact('personales','regiones','estados','actividades','comunas'))
  @include('paciente.morbidos.modal_editar', compact('morbido', 'fecha_morbido'))
  @include('paciente.morbidos.modal_habitos', compact('habitos'))
  @include('paciente.morbidos.modal_medicamentos', compact('medicamentos'))
  @include('paciente.morbidos.modal_enfermedades', compact('enfermedades'))
  @include('paciente.morbidos.modal_patologias', compact('patologias'))
  @include('paciente.morbidos.modal_protocolo')
  @include('paciente.examen.modal_editar', compact('examen', 'fecha_examen'))
  @include('paciente.atencion.modal_atencion')
  <script type="text/javascript">
 
    </script>
@endsection

