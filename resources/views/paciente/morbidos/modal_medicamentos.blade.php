<div id="modal_medicamentos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
  
      <!-- Modal content-->
        <div class="modal-content bg-modal">
            <div class="modal-header bg-modal">
                <h4 class="modal-title">Medicamentos Paciente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-modal">
                <div class="table-responsive">
                    <table class="table display responsive no-wrap table-sm" id="tabla_medicamento" style="width:100% !important;">
                        <thead>
                            <tr>
                            <th scope="col">Nombre Medicamento</th>
                            <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </br>
                <form class="needs-validation" id="agregar_medicamento">
                    <div class="form-row">
                    <div class="col-8">
                        <label for="nombre_paciente">Agrega Medicamento</label>
                        <input class="form-control selectize-single" id="nombre_medicamento" name="nombre_medicamento" type="text" placeholder="Ingrese Medicamento" required>
                            <datalist>
                                @isset($medicamentos)
                                @foreach ($medicamentos as $enf)
                                <option value="{{$enf->id}}">{{$enf->nombre_medicamento}}</option>
                                @endforeach   
                                @endisset
                            </datalist>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-modal">
                <button class="btn btn-success" type="submit" id="boton_medicamento" form="agregar_medicamento">Agregar Medicamento</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
  
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#modal_medicamentos").draggable({handle:'.modal-header', cursor: "grabbing"});
        $("#agregar_medicamento").submit(function(e){
            e.preventDefault();
            alertify.confirm('Agregar Medicamento', '¿Esta seguro/a de que quiere agregar este medicamento?', function(){
                idleTime = 0;
                modal = cargando("Agregar Medicamento", "Agregando...");
                var formdata = new FormData(document.getElementById("agregar_medicamento"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('id_morbido',$('#fecha_morbido').val());
                document.getElementById("boton_medicamento").disabled = true;
                $.ajax({
                    url: '../agregar_medicamento',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            alertify.success(data.mensaje);
                            document.getElementById("boton_medicamento").disabled = false;
                            $('#tabla_medicamento').DataTable().ajax.reload();
                            modal.out();
                        }
                        else{
                            document.getElementById("boton_medicamento").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        document.getElementById("boton_medicamento").disabled = false;
                        alertify.error('Ocurrio un error al intentar agregar el medicamento');
                        modal.out();
                    }
                })
                    
                }
                    , function(){ alertify.error('El medicamento no fue agregado')});

        })
    })
    $(document).on('show.bs.modal', '#modal_medicamentos', function (event) {
        idleTime = 0;
        $('#tabla_medicamento').DataTable().clear().destroy();
        $('#tabla_medicamento').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax:{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "../medicamentos_paciente",
        data: {id_paciente:$("#id_paciente").val(),
        id_morbido: $("#fecha_morbido").val()},
        type: 'POST',
        },
        columns:[
                {
                data: 'nombre_medicamento',
                name: 'nombre_medicamento'

                },
                {
                data: 'eliminar',
                name: 'eliminar',
                className: 'text-center'
                }
            ]
        });
        $("#tabla_medicamento").DataTable().columns.adjust().responsive.recalc();
    })
    
    function eliminar_medicamento(id){
        alertify.confirm('Eliminar Medicamento', '¿Esta seguro/a de que quiere eliminar este Medicamento?', function(){
            idleTime = 0;
            modal = cargando("Eliminar Medicamento", "Eliminando...");
            var formdata = new FormData();
            formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
            formdata.append('id_paciente',$('#id_paciente').val());
            formdata.append('id_morbido',$('#fecha_morbido').val());
            formdata.append('id_medicamento',id);
            $.ajax({
                url: '../eliminar_medicamento',
                type: 'POST',
                processData: false,
                contentType: false,
                data : formdata,
                success: function(data){
                    //console.log(respuesta.resultado);
                    //console.log(respuesta.mensaje);
                    if(data.estado=="true"){
                        alertify.success(data.mensaje);
                        $("#tabla_medicamento").DataTable().ajax.reload();
                        modal.out();
                    }
                    else{
                        alertify.error(data.mensaje);
                        modal.out();
                    }
                },
                error: function(){
                    alertify.error('Ocurrio un error al intentar eliminar este medicamento');
                    modal.out();
                }
            })
                
            }
                , function(){ alertify.error('El medicamento no fue eliminado')});
    }
</script>