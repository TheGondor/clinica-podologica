<div id="modal_habitos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
  
      <!-- Modal content-->
        <div class="modal-content bg-modal">
            <div class="modal-header bg-modal">
                <h4 class="modal-title">Habitos Nocivos Paciente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-modal">
                <div class="table-responsive">  
                    <table class="table display responsive no-wrap table-sm" style="width:100% !important;" id="tabla_habito">
                        
                            <thead>
                                <tr>
                                <th scope="col">Nombre Habito</th>
                                <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                    </table>
                </div>
                        </br>
                <form class="needs-validation" id="agregar_habito">
                    <div class="form-row">
                        <div class="col-8">
                        <label for="nombre_paciente">Agrega Habito Nocivo</label>
                        <input type="text" class="form-control" id="nombre_habito" name="nombre_habito" placeholder="Ingrese un habito" required>
                            <datalist>
                        @isset($habitos)
                        @foreach ($habitos as $habito)
                        <option value="{{$habito->id}}">{{$habito->nombre_habito}}</option>
                        @endforeach
                        @endisset
                            </datalist>
                        </div>
                    </div>
                </form></br>
            </div>
            <div class="modal-footer bg-modal">
                <button class="btn btn-primary" type="submit" id="boton_habito" form="agregar_habito">Agregar Habito</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
  
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#modal_habitos").draggable({handle:'.modal-header', cursor: "grabbing"});
        $("#agregar_habito").submit(function(e){
            e.preventDefault();
            alertify.confirm('Agregar Habito', '¿Esta seguro/a de que quiere agregar este habito?', function(){
                idleTime = 0;
                modal = cargando("Agregar Habito", "Agregando...");
                var formdata = new FormData(document.getElementById("agregar_habito"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('id_morbido',$('#fecha_morbido').val());
                document.getElementById("boton_enfermedad").disabled = true;
                $.ajax({
                    url: '../agregar_habito',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            alertify.success(data.mensaje);
                            document.getElementById("boton_habito").disabled = false;
                            $('#tabla_habito').DataTable().ajax.reload();
                            modal.out();
                        }
                        else{
                            document.getElementById("boton_habito").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        document.getElementById("boton_habito").disabled = false;
                        alertify.error('Ocurrio un error al intentar agregar el habito');
                        modal.out();
                    }
                })
                    
                }
                    , function(){ alertify.error('El habito no fue agregado')});

        })
    })
    $(document).on('show.bs.modal', '#modal_habitos', function (event) {
        idleTime = 0;
        $('#tabla_habito').DataTable().clear().destroy();
        $('#tabla_habito').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax:{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "../habitos_paciente",
        data: {id_paciente:$("#id_paciente").val(),
        id_morbido: $("#fecha_morbido").val()},
        type: 'POST',
        },
        columns:[
                {
                data: 'nombre_habito',
                name: 'nombre_habito'

                },
                {
                data: 'eliminar',
                name: 'eliminar',
                className: 'text-center'
                }
            ]
        });
        $("#tabla_habito").DataTable().columns.adjust().responsive.recalc();
    })
    
    function eliminar_habito(id){
        alertify.confirm('Eliminar Habito', '¿Esta seguro/a de que quiere eliminar este habito?', function(){
            idleTime = 0;
            modal = cargando("Eliminar Habito", "Eliminando...");
            var formdata = new FormData();
            formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
            formdata.append('id_paciente',$('#id_paciente').val());
            formdata.append('id_morbido',$('#fecha_morbido').val());
            formdata.append('id_habito',id);
            $.ajax({
                url: '../eliminar_habito',
                type: 'POST',
                processData: false,
                contentType: false,
                data : formdata,
                success: function(data){
                    //console.log(respuesta.resultado);
                    //console.log(respuesta.mensaje);
                    if(data.estado=="true"){
                        alertify.success(data.mensaje);
                        $("#tabla_habito").DataTable().ajax.reload();
                        modal.out();
                    }
                    else{
                        alertify.error(data.mensaje);
                        modal.out();
                    }
                },
                error: function(){
                    alertify.error('Ocurrio un error al intentar eliminar este habito');
                    modal.out();
                }
            })
                
            }
                , function(){ alertify.error('El habito no fue eliminado')});
    }
</script>