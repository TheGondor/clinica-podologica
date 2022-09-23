
<div class="card-body bg-modal">
    <form class="row" id="eliminar_examen_general">
        <div class="col-lg-6 col-sm-6">
            <label for="hta">Examen Fisico General</label>
            <select class="custom-select mr-sm-2" id="fecha_examen" name="id_examen" enabled>
                
                @if ($fecha_examen->count()>0)
                @foreach ($fecha_examen as $fecha)
                @if ($fecha->id == $examen->id)
                <option value="{{$fecha->id}}" selected>{{date('d/m/Y',strtotime($fecha->fecha))}}</option>
                @else
                <option value="{{$fecha->id}}">{{date('d/m/Y',strtotime($fecha->fecha))}}</option>
                @endif
                @endforeach
                @else
                <option value="0">No existen examenes</option>
                @endif
            </select>
          </div>
          @if ($fecha_examen->count()>0)
          <div class="col-lg-6 col-sm-6 mt-2">
            <button class="btn btn-danger mt-4" type="submit" id="boton_eliminar_examen" form="eliminar_examen_general">Eliminar</button>
          </div>
          @else
          <div class="col-lg-6 col-sm-6 mt-2">
            <button class="btn btn-danger mt-4" type="submit" id="boton_eliminar_examen" form="eliminar_examen_general" disabled>Eliminar</button>
          </div>
          @endif
          
          
    </form>
    @isset($examen)
    <form>
        <fieldset disabled>
            <div class="form-row form-group">
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Pulso(radial)</label>
                    <input type="text" class="form-control" id="pulso_radial" name="pulso_radial" value="{{$examen->pulso_radial}}">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">P/A</label>
                    <input type="text" class="form-control" id="pa" name="pa" value="{{$examen->pa}}">
                </div>
                <div class="col-lg-3 col-sm 6">
                    <label for="dm_tipo">Pulso (pedio) [d]</label>
                    <input type="text" class="form-control" id="pulso_pedio_d" name="pulso_pedio_d" value="{{$examen->pulso_pedio_d}}">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Puslo (pedio)[i]</label>
                    <input type="text" class="form-control" id="pulso_pedio_i" name="pulso_pedio_i" value="{{$examen->pulso_pedio_i}}">
                </div>
            </div> 
            <div class="form-row form-group">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Peso (KG)</label>
                    <input type="number" class="form-control" id="peso" name="peso" value="{{$examen->peso}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Talla (cms)</label>
                    <input type="number" class="form-control" id="talla" name="talla" value="{{$examen->talla}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">IMC</label>
                    <input type="number" class="form-control" id="imc" name="imc" value="{{$examen->imc}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Amputacion</label>
                    <select class="custom-select mr-sm-2" id="amputacion" name="amputacion" value="{{$examen->amputacion}}">
                        @if ($examen->amputacion == "SI")
                        <option value="SI" selected>SI</option>  
                        @else
                        <option value="SI">SI</option>
                        @endif

                        @if ($examen->amputacion == "NO")
                        <option value="NO" selected>NO</option>  
                        @else
                        <option value="NO">NO</option>
                        @endif
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Ubicacion</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{$examen->ubicacion}}">
                </div>
            </div>
            <div class="form-row form-group">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">N Calzado</label>
                    <input type="number" class="form-control" id="calzado" name="calzado" value="{{$examen->calzado}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Sensibilidad (d)</label>
                    <input type="text" class="form-control" id="sensibilidad_d" name="sensibilidad_d" value="{{$examen->sensibilidad_d}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Sensibilidad (i)</label>
                    <input type="text" class="form-control" id="sensibilidad_i" name="sensibilidad_i" value="{{$examen->sensibilidad_i}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">T Podal (d)</label>
                    <input type="text" class="form-control" id="t_podal_d" name="t_podal_d" value="{{$examen->t_podal_d}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">T Podal (i)</label>
                    <input type="text" class="form-control" id="t_podal_i" name="t_podal_i" value="{{$examen->t_podal_i}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Varices Extr. Infeior</label>
                    <select class="custom-select  mr-sm-2" id="varices" name="varices">
                        @if ($examen->varices == "SI")
                        <option value="SI" selected>SI</option>  
                        @else
                        <option value="SI">SI</option>
                        @endif

                        @if ($examen->varices == "NO")
                        <option value="NO" selected>NO</option>  
                        @else
                        <option value="NO">NO</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Heridas</label>
                    <select class="custom-select  mr-sm-2" id="herida">
                        @if ($examen->herida == "SI")
                        <option value="SI" selected>SI</option>  
                        @else
                        <option value="SI">SI</option>
                        @endif

                        @if ($examen->herida == "NO")
                        <option value="NO" selected>NO</option>  
                        @else
                        <option value="NO">NO</option>
                        @endif
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Ubicacion</label>
                    <input type="text" class="form-control" id="heridas" name="heridas" value="{{$examen->heridas}}">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="{{$examen->tipo}}">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Tratamiento</label>
                    <input type="text" class="form-control" id="tratamiento" name="tratamiento" value="{{$examen->tratamiento}}">
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Nevos</label>
                    <select class="custom-select mr-sm-2" id="nevo">
                        @if ($examen->nevo == "SI")
                        <option value="SI" selected>SI</option>  
                        @else
                        <option value="SI">SI</option>
                        @endif

                        @if ($examen->nevo == "NO")
                        <option value="NO" selected>NO</option>  
                        @else
                        <option value="NO">NO</option>
                        @endif
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Ubicacion</label>
                    <input type="text" class="form-control" id="nevos" name="nevos" value="{{$examen->nevos}}">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Maculas</label>
                    <select class="custom-select mr-sm-2" id="macula">
                        @if ($examen->macula == "SI")
                        <option value="SI" selected>SI</option>  
                        @else
                        <option value="SI">SI</option>
                        @endif

                        @if ($examen->macula == "NO")
                        <option value="NO" selected>NO</option>  
                        @else
                        <option value="NO">NO</option>
                        @endif
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Tipo</label>
                    <input type="text" class="form-control" id="maculas" name="maculas" value="{{$examen->maculas}}">
                </div>
            </div>
        </fieldset>
    </form>
    @endisset
    @empty($examen)
    <form>
        <fieldset disabled>
            <div class="form-row form-group">
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Pulso(radial)</label>
                    <input type="text" class="form-control" id="pulso_radial" name="pulso_radial">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">P/A</label>
                    <input type="text" class="form-control" id="pa" name="pa">
                </div>
                <div class="col-lg-3 col-sm 6">
                    <label for="dm_tipo">Pulso (pedio) [d]</label>
                    <input type="text" class="form-control" id="pulso_pedio_d" name="pulso_pedio_d">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Puslo (pedio)[i]</label>
                    <input type="text" class="form-control" id="pulso_pedio_i" name="pulso_pedio_i">
                </div>
            </div> 
            <div class="form-row form-group">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Peso (KG)</label>
                    <input type="number" class="form-control" id="peso" name="peso">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Talla (cms)</label>
                    <input type="number" class="form-control" id="talla" name="talla">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">IMC</label>
                    <input type="number" class="form-control" id="imc" name="imc">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Amputacion</label>
                    <select class="custom-select mr-sm-2" id="amputacion">
                        <option>SI</option>
                        <option>NO</option>
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Ubicacion</label>
                    <input type="text" class="form-control" id="ubicacion" name="amputacion">
                </div>
            </div>
            <div class="form-row form-group">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">N Calzado</label>
                    <input type="number" class="form-control" id="calzado" name="calzado">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Sensibilidad (d)</label>
                    <input type="text" class="form-control" id="sensibilidad_d" name="sensibilidad_d">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Sensibilidad (i)</label>
                    <input type="text" class="form-control" id="sensibilidad_i" name="sensibilidad_i">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">T Podal (d)</label>
                    <input type="text" class="form-control" id="t_podal_d" name="t_podal_d">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">T Podal (i)</label>
                    <input type="text" class="form-control" id="t_podal_i" name="t_podal_i">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Varices Extr. Infeior</label>
                    <select class="custom-select  mr-sm-2" id="varices" name="varices">
                        <option value="SI" >SI</option>
                        <option value="NO" >NO</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Heridas</label>
                    <select class="custom-select  mr-sm-2" id="herida">
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Ubicacion</label>
                    <input type="text" class="form-control" id="heridas" name="heridas">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo">
                </div>
                <div class="col-lg-3 col-sm-6">
                    <label for="dm_evolucion">Tratamiento</label>
                    <input type="text" class="form-control" id="tratamiento" name="tratamiento">
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Nevos</label>
                    <select class="custom-select mr-sm-2" id="nevo" >
                        <option>SI</option>
                        <option>NO</option>
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Ubicacion</label>
                    <input type="text" class="form-control" id="nevos" name="nevos">
                </div>
                <div class="col-lg-2 col-sm-4">
                    <label for="dm_evolucion">Maculas</label>
                    <select class="custom-select mr-sm-2" id="macula">
                        <option>SI</option>
                        <option>NO</option>
                    </select>
                </div>
                <div class="col-lg-4 col-sm-8">
                    <label for="dm_evolucion">Tipo</label>
                    <input type="text" class="form-control" id="maculas" name="maculas">
                </div>
            </div>
        </fieldset>
    </form>
    @endempty
    @if ($fecha_examen->count()==0)
    <button class="btn btn-primary w-100 mt-3" data-toggle="modal" id="boton_agregar_examen" data-target="#editar_examen">Agregar Examen Fisico General</button>
    @else
    <button class="btn btn-primary w-100 mt-3" data-toggle="modal" id="boton_agregar_examen" data-target="#editar_examen">Agregar o Editar Examen Fisico General</button>
    @endif
</div>
<script>
$(document).ready(function(){
    $("#fecha_examen").change(function(){
        modal = cargando("Examen Fisico General", "Cargando...");
        idleTime = 0;
        $.ajax({
            url: '../ver_examen',
            type: 'POST',
            data: {
                id_examen: $("#fecha_examen").val(),
                _token :  $('meta[name="csrf-token"]').attr('content'),
                id_paciente: $("#id_paciente").val()
            },
            dataType : 'json',
            success: function(data,status,xhr){
                alertify.success(data.mensaje);
                $("#pulso_radial").val(data.examen.pulso_radial);
                    $("#pa").val(data.examen.pa);
                    $("#pulso_pedio_d").val(data.examen.pulso_pedio_d);
                    $("#pulso_pedio_i").val(data.examen.pulso_pedio_i);
                    $("#peso").val(data.examen.peso);
                    $("#talla").val(data.examen.talla);
                    $("#imc").val(data.examen.imc);
                    $("#ubicacion").val(data.examen.ubicacion);
                    $("#amputacion").val(data.examen.amputacion)
                    $("#calzado").val(data.examen.calzado);
                    $("#sensibilidad_d").val(data.examen.sensibilidad_d);
                    $("#sensibilidad_i").val(data.examen.sensibilidad_i);
                    $("#t_podal_d").val(data.examen.t_podal_d);
                    $("#t_podal_i").val(data.examen.t_podal_i);
                    $("#varices").val(data.examen.varices);
                    $("#heridas").val(data.examen.heridas);
                    $("#herida").val(data.examen.herida);
                    $("#tipo").val(data.examen.tipo);
                    $("#tratamiento").val(data.examen.tratamiento);
                    $("#nevos").val(data.examen.nevos);
                    $("#nevo").val(data.examen.nevo)
                    $("#maculas").val(data.examen.maculas);
                    $("#macula").val(data.examen.macula);

                    $("#pulso_radial2").val(data.examen.pulso_radial);
                    $("#pa2").val(data.examen.pa);
                    $("#pulso_pedio_d2").val(data.examen.pulso_pedio_d);
                    $("#pulso_pedio_i2").val(data.examen.pulso_pedio_i);
                    $("#peso2").val(data.examen.peso);
                    $("#talla2").val(data.examen.talla);
                    $("#imc2").val(data.examen.imc);
                    $("#ubicacion2").val(data.examen.ubicacion);
                    $("#amputacion2").val(data.examen.amputacion)
                    $("#calzado2").val(data.examen.calzado);
                    $("#sensibilidad_d2").val(data.examen.sensibilidad_d);
                    $("#sensibilidad_i2").val(data.examen.sensibilidad_i);
                    $("#t_podal_d2").val(data.examen.t_podal_d);
                    $("#t_podal_i2").val(data.examen.t_podal_i);
                    $("#varices2").val(data.examen.varices);
                    $("#heridas2").val(data.examen.heridas);
                    $("#herida2").val(data.examen.herida);
                    $("#tipo2").val(data.examen.tipo);
                    $("#tratamiento2").val(data.examen.tratamiento);
                    $("#nevos2").val(data.examen.nevos);
                    $("#nevo2").val(data.examen.nevo)
                    $("#maculas2").val(data.examen.maculas);
                    $("#macula2").val(data.examen.macula);
                    $("#fecha_examen2").val(data.examen.fecha);
                modal.out();
            },
            error: function(){
                modal.out;
                alertify.error("Ocurrio un error al cargar los datos del examen fisico general");
            }
        });
    })

    $("#eliminar_examen_general").submit(function(e){
        e.preventDefault();
            alertify.confirm('Eliminar Examen Fisico General', '¿Esta seguro/a de que quiere eliminar este examen fisico general?', function(){
                idleTime = 0;
                modal = cargando("Eliminar Examen Fisico General", "Eliminando...");
                var formdata = new FormData(document.getElementById("eliminar_examen_general"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                var eliminar = $('#fecha_examen').val();
                document.getElementById("boton_eliminar_examen").disabled = true;
                $.ajax({
                    url: '../eliminar_examen',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            alertify.success(data.mensaje);
                            $("#fecha_examen option[value='"+eliminar+"']").remove();
                            var largo = document.getElementById("fecha_examen").length;
                            if(largo == 0){
                                $("#fecha_morbido").append('<option value="0">No existen examenes fisicos generales</option>');
                                document.getElementById("boton_agregar_examen").innerHTML = "Agregar Examen Fisico General";
                                document.getElementById("boton_examen").innerHTML = "Agregar Examen Fisico General";
                                document.getElementById("boton_eliminar_examen").disabled = true;
                                $("#radio2").addClass("d-none");
                                document.getElementById("edit_2").checked = true;
                                modal.out();
                            }
                            else{
                                document.getElementById("boton_eliminar_examen").disabled = false;
                                modal.out();
                                $('#fecha_examen').trigger('change');
                            }
                            
                            
                        }
                        else{
                            document.getElementById("boton_eliminar_examen").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        document.getElementById("boton_eliminar_examen").disabled = false;
                        alertify.error("Ocurrio un error al intentar eliminar el examen fisico general");
                        modal.out();
                    }
                })
                    
                }
                    , function(){ alertify.error('El examen fisico general no fue eliminado')});

    })
})
</script>