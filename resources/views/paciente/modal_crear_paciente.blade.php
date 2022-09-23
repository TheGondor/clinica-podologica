<div class="modal fade bd-example-modal-lg" id="modal_crear_paciente" tabindex="-1" role="dialog" aria-labelledby="modal_crear_paciente" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content py-2 bg-modal">
        <div class="modal-header bg-modal">
          <div class="modal-title">Agregar Paciente</div>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body bg-modal">
            <form class="needs-validation row" id="crear_paciente">
                  <div class="col-lg-8 col-sm-12">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre" required>
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <label for="nacimiento">Fecha Nacimiento</label>
                    <input type="date" class="form-control" name="nacimiento" id="nacimiento"  required>
                  </div> 
                  <div class="col-lg-6 col-sm-12">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Ingrese Domicilio" required>
                  </div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="domicilio_paciente">Region</label>
                    <select id="id_region" name="id_region" class="form-control" onchange="llenarcomunas()" required>
                        <option value="" selected>Seleccione Region</option>
                        @isset($regiones)
                        @foreach ($regiones as $region)
                          <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                        @endisset  
                    </select>
                  </div>
                  <div class="col-lg-3 col-sm-12">
                    <label for="domicilio_paciente">Comuna</label>
                    <select id="id_commune" name="id_commune" class="form-control" disabled required>
                      <option value="">Seleccione Comuna</option>
                    </select>
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <label for="rut_paciente">Rut</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="rut" id="rut" oninput="checkRut(this)" placeholder="Ingrese Rut" required>
                    </div>
                  </div>
                    <div class="col-lg-6 col-sm-12">
                      <label for="estado_civil">E.Civil</label>
                      <input id="id_estado" name="nombre_estado" class="form-control" required>
                        @isset($estados)
                        @foreach ($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->nombre_estado}}</option>
                        @endforeach    
                        @endisset
                    </div>
                    <div class="col-lg-6 col-sm-12">
                      <label for="actividad_paciente">Actividad</label>
                      <div class="input-group">
                        <input id="id_actividad" name="nombre_actividad" class="form-control" required>
                          @isset($actividades)
                          @foreach ($actividades as $actividad)
                          <option value="{{$actividad->id}}">{{$actividad->nombre_actividad}}</option>
                          @endforeach
                          @endisset
                      </div>
                    </div>
                    <div class="form-group col-sm-12 col-lg-6">
                      <label for="telefono_paciente">Telefono</label>
                      <div class="input-group mb-2">
                          <div class="input-group-prepend">
                              <div class="input-group-text">+56</div>
                          </div>
                          <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" oninput="validate(this)" required>
                      </div>
                  </div>
            </form>
        </div>
        <div class="modal-footer bg-modal">
          <input class="btn btn-primary" type="submit" id="agregar_paciente" form="crear_paciente" value="Agregar Paciente">
          <button type="button" class="btn btn-danger" data-dismiss="modal" class="btn">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
        $("#modal_crear_paciente").draggable({handle:'.modal-header', cursor: "grabbing"});
        $("#crear_paciente").submit(function(e){
    e.preventDefault();
    alertify.confirm('Agregar Paciente', '¿Esta seguro/a de que quiere agregar este paciente?', function(){
        modal = cargando("Agregar Paciente", "Agregando...");
        var formdata = new FormData(document.getElementById("crear_paciente"));
        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
        document.getElementById("agregar_paciente").disabled = true;
        $.ajax({
            url: 'agregar_paciente',
            type: 'POST',
            processData: false,
            contentType: false,
            data : formdata,
            success: function(data){
                //console.log(respuesta.resultado);
                //console.log(respuesta.mensaje);
                if(data.estado=="true"){
                    alertify.success(data.mensaje);
                    $('#tabla_pacientes').DataTable().ajax.reload();
                    document.getElementById("agregar_paciente").disabled = false;
                    modal.out();
                }
                else{
                    document.getElementById("agregar_paciente").disabled = false;
                    alertify.error(data.mensaje);
                    modal.out();
                }
            },
            error: function(){
              document.getElementById("agregar_paciente").disabled = false;
                    alertify.error("Ocurrio un error al intentar agregar en paciente");
                    modal.out();
            }
        })
            
        }
            , function(){ alertify.error('El paciente no fue agregado')});

})
    })
        
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