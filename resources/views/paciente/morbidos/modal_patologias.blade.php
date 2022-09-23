<div id="modal_patologias" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg stacked">
  
      <!-- Modal content-->
        <div class="modal-content bg-modal">
            <div class="modal-header bg-modal">
                <h4 class="modal-title">Patologias Paciente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-modal">
                <div class="table-responsive">
                    <table class="table display responsive no-wrap table-sm" id="tabla_patologia" style="width:100% !important;">
                        <thead>
                            <tr>
                            <th scope="col">Nombre Patologia</th>
                            <th scope="col">Tecnica</th>
                            <th scope="col">Protocolo</th>
                            <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                </br>
                <form class="needs-validation" id="agregar_patologia">
                    <div class="form-row">
                        <div class="col-lg-4 col-sm-6">
                            <label for="nombre_paciente">Patologia Podologica</label>
                            <input class="form-control" id="nombre_patologia" list="patologias" name="nombre_patologia" type="text" required>
                                <datalist>
                                    @isset($patologias)
                                    @foreach ($patologias as $pata)
                                    <option value="{{$pata->id}}">{{$pata->nombre_patologia}}</option>
                                    @endforeach
                                    @endisset
                                </datalist>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <label for="nombre_paciente">Tecnica Podologica</label>
                            <input type="text" class="form-control" id="tecnica" name="tecnica" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="nombre_paciente">Nombre Protocolo</label>
                            <input class="form-control" id="nombre_protocolo" name="nombre_protocolo" type="text" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-modal">
                <button class="btn btn-success" type="submit" id="boton_patologia" form="agregar_patologia">Agregar Patologia</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
  
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
        $("#modal_patologias").draggable({handle:'.modal-header', cursor: "grabbing"});
        $("#agregar_patologia").submit(function(e){
            e.preventDefault();
            alertify.confirm('Agregar Patologia', '¿Esta seguro/a de que quiere agregar esta patologia?', function(){
                idleTime = 0;
                modal = cargando("Agregar Patologia", "Agregando...");
                var formdata = new FormData(document.getElementById("agregar_patologia"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('id_morbido',$('#fecha_morbido').val());
                document.getElementById("boton_patologia").disabled = true;
                $.ajax({
                    url: '../agregar_patologia',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            alertify.success(data.mensaje);
                            document.getElementById("boton_patologia").disabled = false;
                            $('#tabla_patologia').DataTable().ajax.reload();
                            modal.out();
                        }
                        else{
                            document.getElementById("boton_patologia").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        document.getElementById("boton_patologia").disabled = false;
                        alertify.error('Ocurrio un error al intentar agregar la patologia');
                        modal.out();
                    }
                })
                    
                }
                    , function(){ alertify.error('La patologia no fue agregada')});

        })
    })
    
    function eliminar_patologia(id){
        alertify.confirm('Eliminar Patologia', '¿Esta seguro/a de que quiere eliminar esta patologia?', function(){
            idleTime = 0;
            modal = cargando("Eliminar Patologia", "Eliminando...");
            var formdata = new FormData();
            formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
            formdata.append('id_paciente',$('#id_paciente').val());
            formdata.append('id_morbido',$('#fecha_morbido').val());
            formdata.append('id_patologia',id);
            $.ajax({
                url: '../eliminar_patologia',
                type: 'POST',
                processData: false,
                contentType: false,
                data : formdata,
                success: function(data){
                    //console.log(respuesta.resultado);
                    //console.log(respuesta.mensaje);
                    if(data.estado=="true"){
                        alertify.success(data.mensaje);
                        $("#tabla_patologia").DataTable().ajax.reload();
                        modal.out();
                    }
                    else{
                        alertify.error(data.mensaje);
                        modal.out();
                    }
                },
                error: function(){
                    alertify.error('Ocurrio un error al intentar eliminar esta patologia');
                    modal.out();
                }
            })
                
            }
                , function(){ alertify.error('La patologia no fue eliminada')});
    }

    function ver_patologia(id) {
        idleTime = 0;
        $("#id_protocolo").val(id);
        $('#tabla_protocolo').DataTable().clear().destroy();
        $('#tabla_protocolo').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax:{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "../protocolos_paciente",
        data: {id_paciente:$("#id_paciente").val(),
        id_morbido: $("#fecha_morbido").val(),
        id_patologia: id},
        type: 'POST',
        },
        columns:[
            {
                data: 'numero',
                name: 'numero'

                },
                {
                data: 'nombre_etapa',
                name: 'nombre_etapa'

                },
                {
                data: 'descripcion_etapa',
                name: 'descripcion_etapa'

                },
                {
                data: 'accion',
                name: 'accion',
                className: 'text-center'
                }
            ]
        });
        $("#tabla_protocolo").DataTable().columns.adjust().responsive.recalc();
        $('#modal_protocolos').modal('show');
    }
</script>