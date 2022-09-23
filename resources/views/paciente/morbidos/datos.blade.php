
<div class="card-body bg-modal">
    <form class="row" id="eliminar_antecedentes_morbidos">
        <div class="col-lg-6 col-sm-6">
            <label for="hta">Fecha Antecedentes Morbidos</label>
            <select class="custom-select mr-sm-2" id="fecha_morbido" name="id_morbido" enabled>
                @if ($fecha_morbido->count()>0)
                @foreach ($fecha_morbido as $fecha)
                @if ($fecha->id == $morbido->id)
                <option value="{{$fecha->id}}" selected>{{date('d/m/Y',strtotime($fecha->fecha))}}</option>
                @else
                <option value="{{$fecha->id}}">{{date('d/m/Y',strtotime($fecha->fecha))}}</option>
                @endif
                @endforeach
                @else
                <option value="0">No existen antecedentes morbidos</option>
                @endif
            </select>
          </div>
          @if ($fecha_morbido->count()>0)
          <div class="col-lg-6 col-sm-6 mt-2">
            <button class="btn btn-danger mt-4" type="submit" id="boton_eliminar_morbido" form="eliminar_antecedentes_morbidos">Eliminar</button>
          </div>
          @else
          <div class="col-lg-6 col-sm-6 mt-2">
            <button class="btn btn-danger mt-4" type="submit" id="boton_eliminar_morbido" form="eliminar_antecedentes_morbidos" disabled>Eliminar</button>
          </div>
          @endif
          
          
    </form>
    <form class="needs-validation" id="ver_morbido">
        <div class="form-row">  
            <div class="col-lg-2 col-sm-6">
                <label for="hta">HTA</label>
                <select class="custom-select mr-sm-2" id="hta" name="hta" disabled>
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
                <div class="col-lg-2 col-sm-12">
                <label for="dm">DM</label>
                <select class="custom-select mr-sm-2" id="dm" name="dm" disabled>
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
                <div class="col-lg-6 col-sm-12">
                <label for="tipo">Tipo</label>
                @isset($morbido)
                <input type="text" class="form-control" id="tipo_dm" value="{{$morbido->tipo}}" disabled>
                @endisset
                @empty($morbido)
                <input type="text" class="form-control" id="tipo_dm" name="tipo">
                @endempty
                </div>
                <div class="col-lg-2 col-sm-12">
                <label for="dm_evolucion">Años Evolucion</label>
                @isset($morbido)
                <input type="number" class="form-control" id="anos_evolucion" value="{{$morbido->anos_evolucion}}" disabled>
                @endisset
                @empty($morbido)
                <input type="number" class="form-control" id="anos_evolucion" >
                @endempty
                
                </div>
            </div> 
        <fieldset disabled>
            <div class="form-row">
                <div class="col-lg-6 col-sm-6">
                <label for="hta">PCTE Mixto</label>
                <select class="custom-select mr-sm-2" id="pcte_mixto" name="pcte_mixto">
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
                <select class="custom-select mr-sm-2" id="control" name="control">
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
                <div class="col-12">
                    <label for="alteraciones">Alteraciones Ortopedicas</label>
                    @isset($morbido)
                    <input type="text" class="form-control" id="ortopedia" name="ortopedia" value="{{$morbido->ortopedia}}">
                    @endisset
                @empty($morbido)
                <input type="text" class="form-control" id="ortopedia" name="ortopedia" >
                @endempty
                </div>
            </div>
        </fieldset>      
    </form>
    <div class="row">
        @if ($fecha_morbido->count()>0)
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_medicamentos" data-target="#modal_medicamentos">Ver Medicamentos</button>
        </div>
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_enfermedades" data-target="#modal_enfermedades">Ver Enfermedades</button>
        </div>
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_patologias" data-target="#modal_patologias">Ver Patologias</button>
        </div>
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_habitos" data-target="#modal_habitos">Ver Habitos</button>
        </div>
        <div class="col-12 mt-3 p-2">
            <button class="btn btn-primary w-100" data-toggle="modal"  id="boton_agregar_morbido" data-target="#modal_morbidos">Agregar o Editar Antecedentes Morbidos</button>
        </div> 
        @else
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_medicamentos" data-target="#modal_medicamentos" disabled>Ver Medicamentos</button>
        </div>
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_enfermedades" data-target="#modal_enfermedades" disabled>Ver Enfermedades</button>
        </div>
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_patologias" data-target="#modal_patologias" disabled>Ver Patologias</button>
        </div>
        <div class="col-sm-12 col-md-3 mt-3 p-2">
            <button class="btn btn-success w-100" data-toggle="modal" id="boton_ver_habitos" data-target="#modal_habitos" disabled>Ver Habitos</button>
        </div>
        <div class="col-12 mt-3 p-2">
            <button class="btn btn-primary w-100" data-toggle="modal" id="boton_agregar_morbido" data-target="#modal_morbidos">Agregar Antecedentes Morbidos</button>
        </div> 
        @endif
          
    </div>
</div>
<script>
$(document).ready(function(){
    $("#fecha_morbido").change(function(){
        idleTime = 0;
        modal = cargando("Antecedentes Morbidos", "Cargando...");
        $.ajax({
            url: '../ver_morbido',
            type: 'POST',
            data: {
                id_morbido: $("#fecha_morbido").val(),
                _token :  $('meta[name="csrf-token"]').attr('content'),
                id_paciente: $("#id_paciente").val()
            },
            dataType : 'json',
            success: function(data,status,xhr){
                alertify.success(data.mensaje);
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
                modal.out();
            },
            error: function(){
                modal.out();
                alertify.error("Ocurrio un error al cargar los antecedentes morbidos");
            }
        });
    })

    $("#eliminar_antecedentes_morbidos").submit(function(e){
        e.preventDefault();
            alertify.confirm('Eliminar Antecedentes Morbidos', '¿Esta seguro/a de que quiere eliminar estos antecedentes morbidos?', function(){
                idleTime = 0;
                modal = cargando("Eliminar Antecedentes Morbidos", "Eliminando...");
                var formdata = new FormData(document.getElementById("eliminar_antecedentes_morbidos"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                var eliminar = $('#fecha_morbido').val();
                document.getElementById("boton_eliminar_morbido").disabled = true;
                $.ajax({
                    url: '../eliminar_morbido',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            alertify.success(data.mensaje);
                            $("#fecha_morbido option[value='"+eliminar+"']").remove();
                            var largo = document.getElementById("fecha_morbido").length;
                            if(largo == 0){
                                $("#fecha_morbido").append('<option value="0">No existen antecedentes morbidos</option>');
                                document.getElementById("boton_agregar_morbido").innerHTML = "Agregar Antecedentes Morbidos";
                                document.getElementById("boton_morbido").innerHTML = "Agregar Antecedentes Morbidos";
                                document.getElementById("boton_eliminar_morbido").disabled = true;
                                document.getElementById("boton_ver_enfermedades").disabled = true;
                                document.getElementById("boton_ver_medicamentos").disabled = true;
                                document.getElementById("boton_ver_habitos").disabled = true;
                                document.getElementById("boton_ver_patologias").disabled = true;
                                $("#radio1").addClass("d-none");
                                document.getElementById("gridRadios2").checked = true;
                                modal.out();
                            }
                            else{
                                document.getElementById("boton_eliminar_morbido").disabled = false;
                                modal.out();
                                $('#fecha_morbido').trigger('change');
                            }
                            
                        }
                        else{
                            document.getElementById("boton_eliminar_morbido").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        alertify.error('Ocurrio un error al intentar eliminar los antecedentes morbidos')
                        document.getElementById("boton_eliminar_morbido").disabled = false;
                        modal.out();
                    }
                })
                    
                }
                    , function(){ alertify.error('Los antecedentes morbidos no fueron eliminados')});

    })
})
    $("#boton_ver_patologias").click(function(){
        idleTime = 0;
        console.log("modal patologia");
        $('#tabla_patologia').DataTable().clear().destroy();
        $('#tabla_patologia').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax:{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "../patologias_paciente",
        data: {id_paciente:$("#id_paciente").val(),
        id_morbido: $("#fecha_morbido").val()},
        type: 'POST',
        },
        columns:[
                {
                data: 'nombre_patologia',
                name: 'nombre_patologia'

                },
                {
                data: 'tecnica',
                name: 'tecnica'

                },
                {
                data: 'protocolo',
                name: 'protocolo'

                },
                {
                data: 'accion',
                name: 'accion',
                className: 'text-center'
                }
            ]
        });
        $("#tabla_patologia").DataTable().columns.adjust().responsive.recalc();
    })
</script>
