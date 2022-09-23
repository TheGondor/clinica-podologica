<!-- Modal -->
<div id="editar_examen" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">
  
      <!-- Modal content-->
        <div class="modal-content bg-modal">
            <div class="modal-header bg-modal">
                <h4 class="modal-title">Editar Examen Fisico General</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-modal">
                @isset($examen)
                <form id="agregar_examen">
                    <div class="form-row form-group">
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Pulso(radial)</label>
                            <input type="text" class="form-control" id="pulso_radial2" name="pulso_radial" value="{{$examen->pulso_radial}}">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">P/A</label>
                            <input type="text" class="form-control" id="pa2" name="pa" value="{{$examen->pa}}">
                        </div>
                        <div class="col-lg-3 col-sm 6">
                            <label for="dm_tipo">Pulso (pedio) [d]</label>
                            <input type="text" class="form-control" id="pulso_pedio_d2" name="pulso_pedio_d" value="{{$examen->pulso_pedio_d}}">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Puslo (pedio)[i]</label>
                            <input type="text" class="form-control" id="pulso_pedio_i2" name="pulso_pedio_i" value="{{$examen->pulso_pedio_i}}">
                        </div>
                    </div> 
                    <div class="form-row form-group">
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Peso (KG)</label>
                            <input type="number" class="form-control" id="peso2" name="peso" value="{{$examen->peso}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Talla (cms)</label>
                            <input type="number" class="form-control" id="talla2" name="talla" value="{{$examen->talla}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">IMC</label>
                            <input type="number" class="form-control" id="imc2" name="imc" value="{{$examen->imc}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Amputacion</label>
                            <select class="custom-select mr-sm-2" id="amputacion2" name="amputacion">
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
                            <input type="text" class="form-control" id="ubicacion2" name="ubicacion" value="{{$examen->ubicacion}}">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">N Calzado</label>
                            <input type="number" class="form-control" id="calzado2" name="calzado" value="{{$examen->calzado}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Sensibilidad (d)</label>
                            <input type="text" class="form-control" id="sensibilidad_d2" name="sensibilidad_d" value="{{$examen->sensibilidad_d}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Sensibilidad (i)</label>
                            <input type="text" class="form-control" id="sensibilidad_i2" name="sensibilidad_i" value="{{$examen->sensibilidad_i}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">T Podal (d)</label>
                            <input type="text" class="form-control" id="t_podal_d2" name="t_podal_d" value="{{$examen->t_podal_d}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">T Podal (i)</label>
                            <input type="text" class="form-control" id="t_podal_i2" name="t_podal_i" value="{{$examen->t_podal_i}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Varices</label>
                            <select class="custom-select  mr-sm-2" id="varices2" name="varices" value="{{$examen->varices}}">
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
                            <select class="custom-select  mr-sm-2" id="herida2" name="herida">
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
                            <input type="text" class="form-control" id="heridas2" name="heridas" value="{{$examen->heridas}}">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Tipo</label>
                            <input type="text" class="form-control" id="tipo2" name="tipo" value="{{$examen->tipo}}">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Tratamiento</label>
                            <input type="text" class="form-control" id="tratamiento2" name="tratamiento" value="{{$examen->tratamiento}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Nevos</label>
                            <select class="custom-select mr-sm-2" id="nevo2" name="nevo">
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
                            <input type="text" class="form-control" id="nevos2" name="nevos" value="{{$examen->nevos}}">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Maculas</label>
                            <select class="custom-select mr-sm-2" id="macula2" name="macula">
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
                        <div class="col-sm-12 col-lg-4">
                            <label for="alteraciones">Fecha</label>
                            <input type="date" class="form-control" name="fecha" value="{{date('Y-m-d',strtotime($examen->fecha))}}" id="fecha_examen2">
                        </div>
                        
                    </div>
                    <div class="form-check" id="radio2">
                        <input class="form-check-input" type="radio" name="gridRadios2" id="edit_1" value="Editar" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Editar Antencedentes Morbidos
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios2" id="edit_2" value="Agregar">
                        <label class="form-check-label" for="gridRadios2">
                            Nuevo Antecedentes Morbidos
                        </label>
                    </div>
                </form>
                @endisset
                @empty($examen)
                <form id="agregar_examen">
                    <div class="form-row form-group">
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Pulso(radial)</label>
                            <input type="text" class="form-control" id="pulso_radial2" name="pulso_radial">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">P/A</label>
                            <input type="text" class="form-control" id="pa2" name="pa">
                        </div>
                        <div class="col-lg-3 col-sm 6">
                            <label for="dm_tipo">Pulso (pedio) [d]</label>
                            <input type="text" class="form-control" id="pulso_pedio_d2" name="pulso_pedio_d">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Puslo (pedio)[i]</label>
                            <input type="text" class="form-control" id="pulso_pedio_i2" name="pulso_pedio_i">
                        </div>
                    </div> 
                    <div class="form-row form-group">
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Peso (KG)</label>
                            <input type="number" class="form-control" id="peso2" name="peso">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Talla (cms)</label>
                            <input type="number" class="form-control" id="talla2" name="talla">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">IMC</label>
                            <input type="number" class="form-control" id="imc2" name="imc">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Amputacion</label>
                            <select class="custom-select mr-sm-2" id="amputacion2" name="amputacion">
                                <option value="SI" >SI</option>
                                <option value="NO" >NO</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-8">
                            <label for="dm_evolucion">Ubicacion</label>
                            <input type="text" class="form-control" id="ubicacion2" name="ubicacion">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">N Calzado</label>
                            <input type="number" class="form-control" id="calzado2" name="calzado">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Sensibilidad (d)</label>
                            <input type="text" class="form-control" id="sensibilidad_d2" name="sensibilidad_d">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Sensibilidad (i)</label>
                            <input type="text" class="form-control" id="sensibilidad_i2" name="sensibilidad_i">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">T Podal (d)</label>
                            <input type="text" class="form-control" id="t_podal_d2" name="t_podal_d">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">T Podal (i)</label>
                            <input type="text" class="form-control" id="t_podal_i2" name="t_podal_i">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Varices</label>
                            <select class="custom-select  mr-sm-2" id="varices2" name="varices">
                                <option value="SI" >SI</option>
                                <option value="NO" >NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Heridas</label>
                            <select class="custom-select  mr-sm-2" id="herida2" name="herida">
                                <option value="SI" >SI</option>
                                <option value="NO" >NO</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-8">
                            <label for="dm_evolucion">Ubicacion</label>
                            <input type="text" class="form-control" id="heridas2" name="heridas">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Tipo</label>
                            <input type="text" class="form-control" id="tipo2" name="tipo">
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="dm_evolucion">Tratamiento</label>
                            <input type="text" class="form-control" id="tratamiento2" name="tratamiento">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Nevos</label>
                            <select class="custom-select mr-sm-2" id="nevo2" name="nevo">
                                <option value="SI" >SI</option>
                                <option value="NO" >NO</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-8">
                            <label for="dm_evolucion">Ubicacion</label>
                            <input type="text" class="form-control" id="nevos2" name="nevos">
                        </div>
                        <div class="col-lg-2 col-sm-4">
                            <label for="dm_evolucion">Maculas</label>
                            <select class="custom-select mr-sm-2" id="macula2" name="macula">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-8">
                            <label for="dm_evolucion">Tipo</label>
                            <input type="text" class="form-control" id="maculas" name="maculas">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <label for="alteraciones">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="{{date('Y-m-d',time())}}" id="fecha_examen2">
                    </div>
                    <div class="form-check d-none" id="radio2">
                        <input class="form-check-input" type="radio" name="gridRadios2" id="edit_1" value="Editar">
                        <label class="form-check-label" for="gridRadios1">
                            Editar Antencedentes Morbidos
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios2" id="edit_2" value="Agregar" checked>
                        <label class="form-check-label" for="gridRadios2">
                            Nuevo Antecedentes Morbidos
                        </label>
                        </div>
                </form>
                @endempty
                
            </div>
            <div class="modal-footer bg-modal">
                @if ($fecha_examen->count()==0)
                <button class="btn btn-success" type="submit" id="boton_examen" form="agregar_examen">Agregar Examen Fisico General</button>
                @else
                <button class="btn btn-success" type="submit" id="boton_examen" form="agregar_examen">Agregar o Editar Examen Fisico General</button>
                @endif
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
  
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#editar_examen").draggable({handle:'.modal-header', cursor: "grabbing"});
    $("#agregar_examen").submit(function(e){
    e.preventDefault();
    const rbs = document.querySelectorAll('input[name="gridRadios2"]');
    
    for (const rb of rbs) {
        if (rb.checked) {
            selectedValue = rb.value;
            break;
        }
    }
    if(selectedValue == "Editar"){
        $mensaje = "Editar Examen Fisico General";
        $mensaje2 = "¿Esta seguro/a de que quiere editar el examen fisico general de este paciente?";
        $error = "El examen fisco general no fue editado";
        $msjmodal = "Editando...";
    }
    else{
        $mensaje = "Agregar Examen Fisico General";
        $mensaje2 = "¿Esta seguro/a de que quiere agregar este examen fisico general a este paciente?";
        $error = "El examen fisico general no fue agregado";
        $msjmodal = "Agregando...";
    }
    alertify.confirm($mensaje, $mensaje2, function(){
        idleTime = 0;
        modal = cargando("Examen fisico general", $msjmodal);
        var formdata = new FormData(document.getElementById("agregar_examen"));
        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
        formdata.append('id_paciente',$('#id_paciente').val());
        formdata.append('id_examen',$('#fecha_examen').val());
        document.getElementById("boton_examen").disabled = true;
        $.ajax({
            url: '../agregar_examen',
            type: 'POST',
            processData: false,
            contentType: false,
            data : formdata,
            success: function(data){
                //console.log(respuesta.resultado);
                //console.log(respuesta.mensaje);
                if(data.estado=="true"){
                    alertify.success(data.mensaje);
                    document.getElementById("boton_examen").disabled = false;
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
                    if(selectedValue != "Editar"){
                        if($("#fecha_morbido").val()==0){
                            $("#fecha_morbido").empty(); 
                        }
                        $("#fecha_examen").append('<option value="'+data.examen['id']+'">'+data.examen['fecha2']+'</option>');
                        $("#fecha_examen").val(data.examen['id']);
                        document.getElementById("boton_agregar_examen").innerHTML = "Agregar o Editar Examen Fisico General";
                        $("#radio2").removeClass("d-none");
                        document.getElementById("boton_examen").innerHTML = "Agregar o Editar Examen Fisico General";
                        document.getElementById("boton_eliminar_examen").disabled = false;
                    }
                    else{
                        $("#fecha_examen option[value='"+data.examen['id']+"']").html(data.examen['fecha2']);
                    }
                    
                    document.getElementById("boton_examen").disabled = false;
                    modal.out();
                }
                else{
                    document.getElementById("boton_examen").disabled = false;
                    alertify.error(data.mensaje);
                    modal.out();
                }
            },
            error: function(){
                document.getElementById("boton_examen").disabled = false;
                alertify.error($error);
                modal.out();
            }
        })
            
        }
            , function(){ alertify.error($error)});
    })
})
    
</script>
