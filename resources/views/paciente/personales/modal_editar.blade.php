<!-- Modal -->
<div id="editar_personales" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
  
      <!-- Modal content-->
        <div class="modal-content bg-modal">
            <div class="modal-header bg-modal">
                <h4 class="modal-title">Editar Antecedentes Personales</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-modal">
                <form class="needs-validation row" id="editar_paciente">
                    <div class="col-lg-8 col-sm-12">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" id="nombre" value="{{$personales->nombre}}"  placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <label for="nacimiento">Fecha Nacimiento</label>
                      <input type="date" class="form-control" name="nacimiento" value="{{$personales->nacimiento}}" id="nacimiento"  required>
                    </div> 
                    <div class="col-lg-6 col-sm-12">
                      <label for="domicilio">Domicilio</label>
                      <input type="text" class="form-control" name="domicilio" id="domicilio" value="{{$personales->domicilio}}" placeholder="Ingrese Domicilio" required>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="domicilio_paciente">Region</label>
                      <select id="id_region" name="id_region" class="form-control" onchange="llenarcomunas()" required>
                          <option value="" selected>Seleccione Region</option>
                          @isset($regiones)
                          @foreach ($regiones as $region)
                          @if ($region->id == $personales->commune->region->id)
                          <option value="{{$region->id}}" selected>{{$region->name}}</option>
                          @else
                          <option value="{{$region->id}}">{{$region->name}}</option>
                          @endif
                          @endforeach
                          @endisset  
                      </select>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                      <label for="domicilio_paciente">Comuna</label>
                      <select id="id_commune" name="id_commune" class="form-control" required>
                        <option value="">Seleccione Comuna</option>
                        @isset($comunas)
                          @foreach ($comunas as $comuna)
                          @if ($comuna->id == $personales->commune->id)
                          <option value="{{$comuna->id}}" selected>{{$comuna->name}}</option>
                          @else
                          <option value="{{$comuna->id}}">{{$comuna->name}}</option>
                          @endif
                          @endforeach
                          @endisset  
                      </select>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                      <label for="rut_paciente">Rut</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="rut" id="rut" oninput="checkRut(this)" value="{{$personales->rut}}" placeholder="Ingrese Rut" required>
                      </div>
                    </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="estado_civil">E.Civil</label>
                        <input id="id_estado" name="nombre_estado" class="form-control" list="estados" value="{{$personales->estado->nombre_estado}}" required>
                        <datalist>
                            @isset($estados)
                          @foreach ($estados as $estado)
                              <option value="{{$estado->nombre_estado}}">{{$estado->nombre_estado}}</option>
                          @endforeach    
                          @endisset
                        </datalist>
                          
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="actividad_paciente">Actividad</label>
                        <div class="input-group">
                          <input id="id_actividad" name="nombre_actividad" list="actividades" value="{{$personales->actividad->nombre_actividad}}" class="form-control" required>
                          <datalist>
                            @isset($actividades)
                            @foreach ($actividades as $actividad)
                            <option value="{{$actividad->nombre_actividad}}">{{$actividad->nombre_actividad}}</option>
                            @endforeach
                            @endisset
                          </datalist>
                            
                        </div>
                      </div>
                      <div class="form-group col-sm-12 col-lg-6">
                        <label for="telefono_paciente">Telefono</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+56</div>
                            </div>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="{{$personales->telefono}}" placeholder="Telefono" oninput="validate(this)" required>
                        </div>
                    </div>
              </form>
            </div>
            <div class="modal-footer bg-modal">
                <button class="btn btn-success" type="submit" id="boton_usuario" form="editar_paciente">Editar Antecedentes Personales</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
  
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#editar_personales").draggable({handle:'.modal-header', cursor: "grabbing"});
    $("#editar_paciente").submit(function(e){
    e.preventDefault();
    alertify.confirm('Editar Paciente', '¿Esta seguro/a de que quiere editar este paciente?', function(){
      idleTime = 0;
        modal = cargando("Editar Paciente", "Editando...");
        var formdata = new FormData(document.getElementById("editar_paciente"));
        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
        formdata.append('id_paciente',$('#id_paciente').val());
        document.getElementById("boton_usuario").disabled = true;
        $.ajax({
            url: '../editar_paciente',
            type: 'POST',
            processData: false,
            contentType: false,
            data : formdata,
            success: function(data){
                //console.log(respuesta.resultado);
                //console.log(respuesta.mensaje);
                if(data.estado=="true"){
                    alertify.success(data.mensaje);
                    document.getElementById("boton_usuario").disabled = false;
                    document.getElementById("name").innerHTML= data.paciente[0]['nombre'];
                    document.getElementById("date").innerHTML= data.paciente[0]['nacimiento'];
                    document.getElementById("adress").innerHTML= data.paciente[0]['domicilio'];
                    document.getElementById("commune").innerHTML= data.paciente[0]['commune']['name'];
                    document.getElementById("region").innerHTML= data.paciente[0]['commune']['region']['name'];
                    document.getElementById("rol").innerHTML= data.paciente[0]['rut'];
                    document.getElementById("status").innerHTML= data.paciente[0]['estado']['nombre_estado'];
                    document.getElementById("activity").innerHTML= data.paciente[0]['actividad']['nombre_actividad'];
                    document.getElementById("phone").innerHTML= data.paciente[0]['telefono'];
                    document.getElementById("boton_usuario").disabled = false;
                    modal.out();
                }
                else{
                    document.getElementById("boton_usuario").disabled = false;
                    alertify.error(data.mensaje);
                    modal.out();
                }
            },
            error: function(){
              document.getElementById("boton_usuario").disabled = false;
              alertify.error("Ocurrio un error al intentar editar el paciente");
              modal.out();
            }
        })
            
        }
            , function(){ alertify.error('El paciente no fue editado')});
    })
})
function llenarcomunas(id_comuna){
    document.getElementById("id_commune").disabled = true;
    idleTime = 0;
        $.ajax({
            url: '../ver_comunas',
            type: 'POST',
            data: {
                id: $("#id_region").val(),
                _token :  $('meta[name="csrf-token"]').attr('content')
            },
            dataType : 'json',
            success: function(data,status,xhr){
                $("#id_commune").empty();
                $("#id_commune").append('<option selected value="">Seleccione Comuna</option>');
                data.forEach(obj => {
                        $("#id_commune").append('<option value="'+obj.id+'">'+obj.name+'</option>');
                });
                document.getElementById("id_commune").disabled = false;
                document.getElementById("id_commune").readOnly = false;
                if(id_comuna != undefined){
                    $("#id_commune").val(id_comuna);
                }
            }
        });
    }

    function validate(data){
      var returnString ='';
      var text = data.value;
      var regex = /[0-9]|\./;
      var anArray = text.split('');
      for(var i=0; i<anArray.length; i++){
      if(!regex.test(anArray[i]))
      {
        anArray[i] = '';
      }
      }
      for(var i=0; i<anArray.length; i++) {
        returnString += anArray[i];
      }
      if(returnString.lenght<9){
        data.value = returnString;
      }
      else{
        data.value = returnString.slice(0,9);
      }
    }

</script>