<input type="hidden" id="id_atencion" value="0">
<div class="card-body bg-modal">
    <table class="table display responsive no-wrap table-sm" id="tabla_atenciones" style="width:100% !important;">
        <thead>
            <tr>
            <th scope="col">Fecha Atencion</th>
            <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table></br>
    <button id="nueva_atencion" class="btn btn-success">Nueva Atencion</button>
</div>
<script>

var atencion = "editar";
    var id_atencion = 0;
    $(document).ready(function(){

    
    $("#boton_ver_atenciones").click(function(){
        idleTime = 0;
        $("#tabla_atenciones").DataTable().clear().destroy();
        $("#tabla_atenciones").DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax:{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "../atenciones_paciente",
        data: {id:$("#id_paciente").val()},
        type: 'POST',
        },
        columns:[
                {
                data: 'atencion_fecha',
                name: 'atencion_fecha'

                },
                {
                data: 'accion',
                name: 'accion',
                className: 'text-center'
                }
            ]
        });
        $("#tabla_atenciones").DataTable().columns.adjust().responsive.recalc();
    })

    $("#nueva_atencion").click(function(){
        $("#modal_atencion").modal("show");
        $("#editar_atencion").hide();
        $("#agregar_atencion").show();
        atencion = "crear";
        document.getElementById("formula_atencion").reset();
        document.getElementById("a_fecha_atencion").disabled = false;
        document.getElementById("a_pa_atencion").disabled = false;
        document.getElementById("a_pulso_radial").disabled = false;
        document.getElementById("a_peso").disabled = false;
        document.getElementById("a_pulso_pedio_d").disabled = false;
        document.getElementById("a_pulso_pedio_i").disabled = false;
        document.getElementById("a_sensibilidad_d").disabled = false;
        document.getElementById("a_sensibilidad_i").disabled = false;
        document.getElementById("a_t_podal").disabled = false;
        document.getElementById("a_atencion_basica").disabled = false;
        document.getElementById("a_curacion").disabled = false;
        document.getElementById("a_colocacion_puente").disabled = false;
        document.getElementById("a_resecado").disabled = false;
        document.getElementById("a_enucleacion").disabled = false;
        document.getElementById("a_devastado_ungueal").disabled = false;
        document.getElementById("a_masoterapia").disabled = false;
        document.getElementById("a_espiculoectomia").disabled = false;
        document.getElementById("a_analgesia").disabled = false;
        document.getElementById("a_colocacion_acrilico").disabled = false;
        document.getElementById("a_colocacion_banda").disabled = false;
        document.getElementById("a_cbracket").disabled = false;
        document.getElementById("a_cpolicarboxilato").disabled = false;
        document.getElementById("a_observacion").disabled = false;
    })
})
    function ver_atencion(id){
        idleTime = 0;
        $("#editar_atencion").hide();
        $("#agregar_atencion").hide();
        id_atencion = id;
        var modal = cargando("Cargando Atencion", "Cargando...");
        $.ajax({
            url : '../atencion_paciente',
            type : 'POST',
            data: {
                id_paciente : $("#id_paciente").val(),
                id_atencion : id,
                _token : $('meta[name="csrf-token"]').attr('content')
            },
            success : function(data){
                $("#a_fecha_atencion").val(data.atencion_fecha);
                $("#a_pa_atencion").val(data.atencion_pa);
                $("#a_pulso_radial").val(data.atencion_pulso_radial);
                $("#a_peso").val(data.atencion_peso);
                $("#a_pulso_pedio_d").val(data.atencion_pedio_d);
                $("#a_pulso_pedio_i").val(data.atencion_pedio_i);
                $("#a_sensibilidad_d").val(data.atencion_sensibilidad_d);
                $("#a_sensibilidad_i").val(data.atencion_sensibilidad_i);
                $("#a_t_podal").val(data.atencion_t_podal);
                $("#a_atencion_basica").val(data.atencion_podal);
                $("#a_curacion").val(data.atencion_curacion);
                $("#a_colocacion_puente").val(data.atencion_colocacion);
                $("#a_resecado").val(data.atencion_resecado);
                $("#a_enucleacion").val(data.atencion_enucleasion);
                $("#a_devastado_ungueal").val(data.atencion_devastado);
                $("#a_masoterapia").val(data.atencion_masoterapia);
                $("#a_espiculoectomia").val(data.atencion_espiculoectomia);
                $("#a_analgesia").val(data.atencion_analgesia);
                $("#a_colocacion_acrilico").val(data.atencion_acrilico);
                $("#a_colocacion_banda").val(data.atencion_banda);
                $("#a_cbracket").val(data.atencion_bracket);
                $("#a_cpolicarboxilato").val(data.atencion_policarboxilato);
                $("#a_observacion").val(data.atencion_descripcion);

                document.getElementById("a_fecha_atencion").disabled = true;
                document.getElementById("a_pa_atencion").disabled = true;
                document.getElementById("a_pulso_radial").disabled = true;
                document.getElementById("a_peso").disabled = true;
                document.getElementById("a_pulso_pedio_d").disabled = true;
                document.getElementById("a_pulso_pedio_i").disabled = true;
                document.getElementById("a_sensibilidad_d").disabled = true;
                document.getElementById("a_sensibilidad_i").disabled = true;
                document.getElementById("a_t_podal").disabled = true;
                document.getElementById("a_atencion_basica").disabled = true;
                document.getElementById("a_curacion").disabled = true;
                document.getElementById("a_colocacion_puente").disabled = true;
                document.getElementById("a_resecado").disabled = true;
                document.getElementById("a_enucleacion").disabled = true;
                document.getElementById("a_devastado_ungueal").disabled = true;
                document.getElementById("a_masoterapia").disabled = true;
                document.getElementById("a_espiculoectomia").disabled = true;
                document.getElementById("a_analgesia").disabled = true;
                document.getElementById("a_colocacion_acrilico").disabled = true;
                document.getElementById("a_colocacion_banda").disabled = true;
                document.getElementById("a_cbracket").disabled = true;
                document.getElementById("a_cpolicarboxilato").disabled = true;
                document.getElementById("a_observacion").disabled = true;

                modal.out();
                $("#modal_atencion").modal("show");
            },
            error: function(){
                modal.out();
                alertify.error("Ocurrio un error al cargar la atencion");
            }
        })
    }

    function editar_atencion(id){
        idleTime = 0;
        $("#modal_atencion").modal("show");
        $("#editar_atencion").show();
        $("#agregar_atencion").hide();
        atencion = "editar";
        id_atencion = id;
        $("#id_atencion").val(id);
        $.ajax({
            url : '../atencion_paciente',
            type : 'POST',
            data: {
                id_paciente : $("#id_paciente").val(),
                id_atencion : id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success : function(data){
                $("#a_fecha_atencion").val(data.atencion_fecha);
                $("#a_pa_atencion").val(data.atencion_pa);
                $("#a_pulso_radial").val(data.atencion_pulso_radial);
                $("#a_peso").val(data.atencion_peso);
                $("#a_pulso_pedio_d").val(data.atencion_pedio_d);
                $("#a_pulso_pedio_i").val(data.atencion_pedio_i);
                $("#a_sensibilidad_d").val(data.atencion_sensibilidad_d);
                $("#a_sensibilidad_i").val(data.atencion_sensibilidad_i);
                $("#a_t_podal").val(data.atencion_t_podal);
                $("#a_atencion_basica").val(data.atencion_podal);
                $("#a_curacion").val(data.atencion_curacion);
                $("#a_colocacion_puente").val(data.atencion_colocacion);
                $("#a_resecado").val(data.atencion_resecado);
                $("#a_enucleacion").val(data.atencion_enucleasion);
                $("#a_devastado_ungueal").val(data.atencion_devastado);
                $("#a_masoterapia").val(data.atencion_masoterapia);
                $("#a_espiculoectomia").val(data.atencion_espiculoectomia);
                $("#a_analgesia").val(data.atencion_analgesia);
                $("#a_colocacion_acrilico").val(data.atencion_acrilico);
                $("#a_colocacion_banda").val(data.atencion_banda);
                $("#a_cbracket").val(data.atencion_bracket);
                $("#a_cpolicarboxilato").val(data.atencion_policarboxilato);
                $("#a_observacion").val(data.atencion_descripcion);

                document.getElementById("a_fecha_atencion").disabled = false;
                document.getElementById("a_pa_atencion").disabled = false;
                document.getElementById("a_pulso_radial").disabled = false;
                document.getElementById("a_peso").disabled = false;
                document.getElementById("a_pulso_pedio_d").disabled = false;
                document.getElementById("a_pulso_pedio_i").disabled = false;
                document.getElementById("a_sensibilidad_d").disabled = false;
                document.getElementById("a_sensibilidad_i").disabled = false;
                document.getElementById("a_t_podal").disabled = false;
                document.getElementById("a_atencion_basica").disabled = false;
                document.getElementById("a_curacion").disabled = false;
                document.getElementById("a_colocacion_puente").disabled = false;
                document.getElementById("a_resecado").disabled = false;
                document.getElementById("a_enucleacion").disabled = false;
                document.getElementById("a_devastado_ungueal").disabled = false;
                document.getElementById("a_masoterapia").disabled = false;
                document.getElementById("a_espiculoectomia").disabled = false;
                document.getElementById("a_analgesia").disabled = false;
                document.getElementById("a_colocacion_acrilico").disabled = false;
                document.getElementById("a_colocacion_banda").disabled = false;
                document.getElementById("a_cbracket").disabled = false;
                document.getElementById("a_cpolicarboxilato").disabled = false;
                document.getElementById("a_observacion").disabled = false;
            },
        })
    }

    function eliminar_atencion(id){
    alertify.confirm('Eliminar Atencion', '¿Esta seguro/a de que quiere eliminar esta atencion?', function(){
        var modal = cargando("Eliminar_atencion", "Eliminando...");
        idleTime = 0;
        $.ajax({
            url: '../eliminar_atencion',
            type: 'POST',
            data : {
                    _token :  $('meta[name="csrf-token"]').attr('content'),
                    id : id,
                    id_paciente: $("#id_paciente").val()
                },
            success: function(data){
                //console.log(respuesta.resultado);
                //console.log(respuesta.mensaje);
                if(data.estado=="true"){
                    alertify.success(data.mensaje);
                    $('#tabla_atenciones').DataTable().ajax.reload();
                }
                else{
                    alertify.error(data.mensaje);
                }
            },
            error: function(){
                modal.out();
                alertify.error("Ocurrio un error al intentar eliminar la atencion");
            }
        })
            
        }
            , function(){ alertify.error('No elimino la atencion')});
    }
     
    $(document).on('submit','#formula_atencion',function(e){
        e.preventDefault();
        e.stopPropagation();
        if(atencion == "crear"){
            alertify.confirm('Agregar Atencion', '¿Esta seguro/a de que quiere agregar esta atencion?', function(){
                idleTime = 0;
                modal = cargando("Agregar Atencion", "Agregando...");
                var formdata = new FormData(document.getElementById("formula_atencion"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                document.getElementById("agregar_atencion").disabled = true;
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '../agregar_atencion',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data :formdata,
                    success: function(data){
                        if(data.estado == "true"){
                            alertify.success(data.mensaje);
                            $("#tabla_atenciones").DataTable().ajax.reload();
                        }
                        else{
                            alertify.error(data.mensaje);
                        }
                        document.getElementById("agregar_atencion").disabled = false;
                        modal.out();
                    },
                    error: function(){
                        alertify.error("Ocurrio un error al intentar agregar la atencion");
                        document.getElementById("agregar_atencion").disabled = false;
                        modal.out();
                    }
                })
            
        }
            , function(){ alertify.error('La atencion no fue agregada')});
        }
        else{
            alertify.confirm('Editar Atencion', '¿Esta seguro/a de que quiere editar esta atencion?', function(){
                idleTime = 0;
                modal = cargando("Editar Atencion", "Editando...");
                var formdata = new FormData(document.getElementById("formula_atencion"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('id_atencion',$('#id_atencion').val());
                document.getElementById("editar_atencion").disabled = true;
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '../editar_atencion',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data :formdata,
                    success: function(data){
                        if(data.estado == "true"){
                            alertify.success(data.mensaje);
                        }
                        else{
                            alertify.error(data.mensaje);
                        }
                        document.getElementById("agregar_atencion").disabled = true;
                        modal.out();
                    },
                    error: function(){
                        alertify.error("Ocurrio un error al intentar editar la atencion");
                        document.getElementById("agregar_atencion").disabled = true;
                        modal.out();
                    }
                })
            
        }
            , function(){ alertify.error('La atencion no fue editada')});
        }
        
    })
</script>
    
