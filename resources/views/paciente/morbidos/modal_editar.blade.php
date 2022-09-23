<div id="modal_morbidos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
  
      <!-- Modal content-->
        <div class="modal-content bg-modal">
            <div class="modal-header bg-modal">
                <h4 class="modal-title">Agregar o Editar Antecedentes Morbidos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-modal">
                <form class="needs-validation" id="editar_morbido">
                    <div class="form-row">
                      <div class="col-lg-2 col-sm-6">
                        <label for="hta">HTA</label>
                        <select class="custom-select mr-sm-2" name="hta" id="hta2">
                            @isset($morbido)
                            @if ($morbido->hta == "SI")
                            <option value="SI" selected>SI</option> 
                            @else
                            <option value="SI" >SI</option> 
                            @endif
                            @if ($morbido->hta == "NO")
                            <option value="NO" selected>NO</option>
                            @else
                            <option value="NO" >NO</option>
                            @endif
                            @if ($morbido->hta == "N/S")
                            <option value="N/S" selected>N/S</option>
                            @else
                            <option value="N/S" >N/S</option>
                            @endif
                            @if ($morbido->hta == "E/EST")
                            <option value="E/EST" selected>E/EST</option> 
                            @else
                            <option value="E/EST" >E/EST</option>  
                            @endif
                            @endisset
                            @empty($morbido)
                            <option value="SI" >SI</option> 
                            <option value="NO" selected >NO</option>
                            <option value="N/S" >N/S</option>
                            <option value="E/EST" >E/EST</option>  
                            @endempty 
                        </select>
                      </div>
                      <div class="col-lg-2 col-sm-6">
                        <label for="dm">DM</label>
                        <select class="custom-select mr-sm-2" name="dm" id="dm2">
                            @isset($morbido)
                            @if ($morbido->dm == "SI")
                            <option value="SI" selected>SI</option> 
                            @else
                            <option value="SI" >SI</option> 
                            @endif
                            @if ($morbido->dm == "NO")
                            <option value="NO" selected>NO</option>
                            @else
                            <option value="NO" >NO</option>
                            @endif
                            @if ($morbido->dm == "N/S")
                            <option value="N/S" selected>N/S</option>
                            @else
                            <option value="N/S" >N/S</option>
                            @endif
                            @if ($morbido->dm == "E/EST")
                            <option value="E/EST" selected>E/EST</option> 
                            @else
                            <option value="E/EST" >E/EST</option>  
                            @endif
                            @endisset   
                            @empty($morbido)
                            <option value="SI" >SI</option> 
                            <option value="NO" selected >NO</option>
                            <option value="N/S" >N/S</option>
                            <option value="E/EST" >E/EST</option>  
                            @endempty   
                        </select>
                      </div>
                      <div class="col-lg-6 col-sm-8">
                        <label for="tipo">Tipo</label>
                        @isset($morbido)
                    <input type="text" class="form-control" name="tipo_dm" value="{{$morbido->tipo}}" id="tipo_dm2">
                    @endisset
                    @empty($morbido)
                    <input type="text" class="form-control" name="tipo_dm" id="tipo_dm2">
                    @endempty
                      </div>
                      <div class="col-lg-2 col-sm-4">
                        <label for="dm_evolucion">Años Evolucion</label>
                        @isset($morbido)
                        <input type="number" class="form-control" name="anos_evolucion" value="{{$morbido->anos_evolucion}}" id="anos_evolucion2">
                        @endisset
                        @empty($morbido)
                        <input type="number" class="form-control" name="anos_evolucion" id="anos_evolucion2">
                        @endempty
                      </div>
                    </div> 
                    <div class="form-row">
                        <div class="col-lg-6 col-sm-6">
                        <label for="hta">PCTE Mixto</label>
                        <select class="custom-select mr-sm-2" name="pcte_mixto" id="pcte_mixto2">
                            @isset($morbido)
                            @if ($morbido->pcte_mixto == "SI")
                            <option value="SI" selected>SI</option> 
                            @else
                            <option value="SI" >SI</option> 
                            @endif
                            @if ($morbido->pcte_mixto == "NO")
                            <option value="NO" selected>NO</option>
                            @else
                            <option value="NO" >NO</option>
                            @endif
                            @endisset    
                            @empty($morbido)
                            <option value="SI" >SI</option> 
                            <option value="NO" selected>NO</option>
                            @endempty     
                        </select>
                      </div>
                      <div class="col-lg-6 col-sm-6">
                        <label for="hta">Control</label>
                        <select class="custom-select mr-sm-2" name="control" id="control2">
                            @isset($morbido)
                            @if ($morbido->control == "SI")
                            <option value="SI" selected>SI</option> 
                            @else
                            <option value="SI" >SI</option> 
                            @endif
                            @if ($morbido->control == "NO")
                            <option value="NO" selected>NO</option>
                            @else
                            <option value="NO" >NO</option>
                            @endif
                            @endisset
                            @empty($morbido)
                            <option value="SI" >SI</option> 
                            <option value="NO" selected>NO</option>
                            @endempty
                        </select>
                      </div>
                    </div>
                      <div class="form-row">
                        <div class="col-sm-12 col-lg-8">
                            <label for="alteraciones">Alteraciones Ortopedicas</label>
                            @isset($morbido)
                            <input type="text" class="form-control" name="ortopedia" value="{{$morbido->ortopedia}}" id="ortopedia2">
                            @endisset
                            @empty($morbido)
                            <input type="text" class="form-control" name="ortopedia" id="ortopedia2">
                            @endempty
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <label for="alteraciones">Fecha</label>
                            @if ($fecha_morbido->count()>0)
                            
                            <input type="date" class="form-control" name="fecha_morbido" value="{{date('Y-m-d',strtotime($morbido->fecha))}}" id="fecha_morbido2">
                            @else
                            <input type="date" class="form-control" name="fecha_morbido" value="{{date('Y-m-d',time())}}" id="fecha_morbido2">
                            @endif
                            
                        </div>
                        <div class="col-sm-10 mt-2">
                            @if ($fecha_morbido->count()>0)
                            <div class="form-check" id="radio1">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Editar" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Editar Antencedentes Morbidos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Agregar">
                                <label class="form-check-label" for="gridRadios2">
                                    Nuevo Antecedentes Morbidos
                                </label>
                                </div>
                            @else
                            <div class="form-check d-none" id="radio1">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Editar">
                                <label class="form-check-label" for="gridRadios1">
                                    Editar Antencedentes Morbidos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Agregar" checked>
                                <label class="form-check-label" for="gridRadios2">
                                    Nuevo Antecedentes Morbidos
                                </label>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-modal">
                @if ($fecha_morbido->count()==0)
                <button class="btn btn-success" type="submit" id="boton_morbido" form="editar_morbido">Agregar Antecedentes Morbidos</button>
                @else
                <button class="btn btn-success" type="submit" id="boton_morbido" form="editar_morbido">Agregar o Editar Antecedentes Morbidos</button>
                @endif
                
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
  
    </div>
</div>
<script type="text/javascript">
var selectedValue;
$(document).ready(function(){
    $("#modal_morbidos").draggable({handle:'.modal-header', cursor: "grabbing"});
    $("#editar_morbido").submit(function(e){
    e.preventDefault();
    const rbs = document.querySelectorAll('input[name="gridRadios"]');
    
    for (const rb of rbs) {
        if (rb.checked) {
            selectedValue = rb.value;
            break;
        }
    }
    if(selectedValue == "Editar"){
        $mensaje = "Editar Antecedentes Morbidos";
        $mensaje2 = "¿Esta seguro/a de que quiere editar los antecedentes morbidos de este paciente?";
        $error = "Los antecedentes morbidos no fueron editados";
        $modalmsj = "Editando...";
    }
    else{
        $mensaje = "Agregar Antecedentes Morbidos";
        $mensaje2 = "¿Esta seguro/a de que quiere agregar estos antecedentes morbidos a este paciente?";
        $error = "Los antecedentes morbidos no fueron agregados";
        $modalmsj = "Agregando...";
    }
    alertify.confirm($mensaje, $mensaje2, function(){
        modal = cargando("Antecedentes morbidos", $modalmsj);
        idleTime = 0;
        var formdata = new FormData(document.getElementById("editar_morbido"));
        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
        formdata.append('id_paciente',$('#id_paciente').val());
        formdata.append('id_morbido',$('#fecha_morbido').val());
        document.getElementById("boton_morbido").disabled = true;
        $.ajax({
            url: '../editar_morbido',
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
                    $("#hta").val(data.morbido['hta']);
                    $("#dm").val(data.morbido['dm']);
                    $("#tipo_dm").val(data.morbido['tipo']);
                    $("#anos_evolucion").val(data.morbido['anos_evolucion']);
                    $("#pcte_mixto").val(data.morbido['pcte_mixto']);
                    $("#control").val(data.morbido['control']);
                    $("#ortopedia").val(data.morbido['ortopedia']);

                    $("#hta2").val(data.morbido['hta']);
                    $("#dm2").val(data.morbido['dm']);
                    $("#tipo_dm2").val(data.morbido['tipo']);
                    $("#anos_evolucion2").val(data.morbido['anos_evolucion']);
                    $("#pcte_mixto2").val(data.morbido['pcte_mixto']);
                    $("#control2").val(data.morbido['control']);
                    $("#ortopedia2").val(data.morbido['ortopedia']);
                    $("#fecha_morbido2").val(data.morbido['fecha']);
                    if(selectedValue != "Editar"){
                        if($("#fecha_morbido").val()==0){
                            $("#fecha_morbido").empty(); 
                        }
                        $("#fecha_morbido").append('<option value="'+data.morbido['id']+'">'+data.morbido['fecha2']+'</option>');
                        $("#fecha_morbido").val(data.morbido['id']);
                        document.getElementById("boton_agregar_morbido").innerHTML = "Agregar o Editar Antecedentes Morbidos";
                        document.getElementById("boton_ver_enfermedades").disabled = false;
                        document.getElementById("boton_ver_medicamentos").disabled = false;
                        document.getElementById("boton_ver_habitos").disabled = false;
                        document.getElementById("boton_ver_patologias").disabled = false;
                        $("#radio1").removeClass("d-none");
                        document.getElementById("boton_morbido").innerHTML = "Agregar o Editar Antecedentes Morbidos";
                        document.getElementById("boton_eliminar_morbido").disabled = false;
                    }
                    else{
                        $("#fecha_morbido option[value='"+data.morbido['id']+"']").html(data.morbido['fecha2']);
                    }
                    
                    document.getElementById("boton_morbido").disabled = false;
                    modal.out();
                }
                else{
                    document.getElementById("boton_morbido").disabled = false;
                    alertify.error(data.mensaje);
                    modal.out();
                }
            },
            error: function(){
                document.getElementById("boton_morbido").disabled = false;
                alertify.error($error);
                modal.out();
            }
        })
            
        }
            , function(){ alertify.error($error)});
    })
})
    
</script>