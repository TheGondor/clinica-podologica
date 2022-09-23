<div id="modal_enfermedades" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
  
      <!-- Modal content-->
        <div class="modal-content bg-modal">
            <div class="modal-header bg-modal">
                <h4 class="modal-title">Enfermedades Paciente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body bg-modal">
                <div class="table-responsive">
                    <table class="table display responsive no-wrap table-sm" id="tabla_enfermedad" style="width:100% !important;">
                        <thead>
                            <tr>
                            <th scope="col">Nombre Enfermedad</th>
                            <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </br>
                <form class="needs-validation" id="agregar_enfermedad">
                    <div class="form-row">
                    <div class="col-8">
                        <label for="nombre_paciente">Agrega Enfermedad</label>
                        <input type="text" list="enfermedades" class="form-control selectize-single" id="nombre_enfermedad" name="nombre_enfermedad" required>
                        <datalist>
                            <option value="">Selecciona Enfermedad</option>
                                @isset($enfermedades)
                                @foreach ($enfermedades as $enf)
                                <option value="{{$enf->id}}">{{$enf->nombre_enfermedad}}</option>
                                @endforeach   
                                @endisset
                        </datalist>
                    </div>
                    </div>
                </form></br>
            </div>
            <div class="modal-footer bg-modal">
                <button class="btn btn-primary" type="submit" id="boton_enfermedad" form="agregar_enfermedad">Agregar Enfermedad</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" class="btn">Cerrar</button>
            </div>
         </div>
  
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        $("#modal_enfermedades").draggable({handle:'.modal-header', cursor: "grabbing"});
        $("#agregar_enfermedad").submit(function(e){
            e.preventDefault();
            alertify.confirm('Agregar Enfermedad', '¿Esta seguro/a de que quiere agregar esta enfermedad?', function(){
                idleTime = 0;
                modal = cargando("Agregar Enfermedad", "Agregando...");
                var formdata = new FormData(document.getElementById("agregar_enfermedad"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('id_morbido',$('#fecha_morbido').val());
                document.getElementById("boton_enfermedad").disabled = true;
                $.ajax({
                    url: '../agregar_enfermedad',
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
                            document.getElementById("boton_enfermedad").disabled = false;
                            $('#tabla_enfermedad').DataTable().ajax.reload();
                            modal.out();
                        }
                        else{
                            document.getElementById("boton_enfermedad").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        document.getElementById("boton_enfermedad").disabled = false;
                        alertify.error("Ocurrio un error al intentar agregar la enfermedad");
                        modal.out();
                    }
                })
                    
                }
                    , function(){ alertify.error('La enfermedad no fue agregada')});

        })
    })
    $(document).on('show.bs.modal', '#modal_enfermedades', function (event) {
        idleTime = 0;
        $('#tabla_enfermedad').DataTable().clear().destroy();
        $('#tabla_enfermedad').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax:{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "../enfermedades_paciente",
        data: {id_paciente:$("#id_paciente").val(),
        id_morbido: $("#fecha_morbido").val()},
        type: 'POST',
        },
        columns:[
                {
                data: 'nombre_enfermedad',
                name: 'nombre_enfermedad'

                },
                {
                data: 'eliminar',
                name: 'eliminar',
                className: 'text-center'
                }
            ]
        });
        $("#tabla_enfermedad").DataTable().columns.adjust().responsive.recalc();
    })
    
    function eliminar_enfermedad(id){
        alertify.confirm('Eliminar Enfermedad', '¿Esta seguro/a de que quiere eliminar esta enfermedad?', function(){
            idleTime = 0;
            modal = cargando("Eliminar Enfermedad", "Eliminando...");
            var formdata = new FormData();
            formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
            formdata.append('id_paciente',$('#id_paciente').val());
            formdata.append('id_morbido',$('#fecha_morbido').val());
            formdata.append('id_enfermedad',id);
            var eliminar = $('#fecha_morbido').val();
            $.ajax({
                url: '../eliminar_enfermedad',
                type: 'POST',
                processData: false,
                contentType: false,
                data : formdata,
                success: function(data){
                    //console.log(respuesta.resultado);
                    //console.log(respuesta.mensaje);
                    if(data.estado=="true"){
                        alertify.success(data.mensaje);
                        $("#tabla_enfermedad").DataTable().ajax.reload();
                        modal.out();
                    }
                    else{
                        alertify.error(data.mensaje);
                        modal.out();
                    }
                },
                error: function(){
                    alertify.error('Ocurrio un error al intentar eliminar esta enfermedad');
                    modal.out();
                }
            })
                
            }
                , function(){ alertify.error('La enfermedad no fue eliminada')});
    }
</script>