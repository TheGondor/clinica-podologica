<div id="modal_protocolos" class="modal fade ">
    <input id="id_protocolo" value="0" type="hidden">
    <div class="modal-dialog modal-xl stacked" role="document">
        <div class="modal-content py-2 bg-modal">
            <div class="modal-header bg-modal">
                <div class="modal-title">Etapas Protocolo Patologia</div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body bg-modal">
                <div class="container">
                    <div class="table-responsive">
                        <table id="tabla_protocolo" style="width: 100% !important;">
                            <thead>
                                <tr>
                                    <th>N° Paso</th>
                                    <th>Descripcion Paso</th>
                                    <th>Comentario</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="container">    
                    <form id="agregar_etapa">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <label for="nacimiento">Descripcion Paso</label>
                                <textarea class="form-control" id="descripcion_etapa" name="nombre_etapa" required></textarea>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <label for="nombre">Comentario</label>
                                <textarea class="form-control" name="comentario" id="descripcion_etapa" required></textarea>
                            </div>
                            <div class="col-lg-3">
                                <label for="nacimiento">Foto</label>
                                <input type="file" class="form-control" name="imagen_url" id="etapa_foto" accept="image/png, image/jpeg" capture oninput="foto_protocolo()">
                            </div>
                        </div></br>
                        <button id="boton_etapa" type="submit" class="btn btn-success" id="boton_etapa">Agregar Etapa Protocolo</button>
                    </form>
                </div></br>
                <div class="container">
                    <div class="row">
                        <div id="lienzo_etapa" class="my-auto col-12"></div>
                    </div>
                </div>
            </div> 
            <div class="modal-footer bg-modal">
                <button type="button" class="btn btn-danger" data-dismiss="modal" class="btn">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#modal_protocolos").draggable({handle:'.modal-header', cursor: "grabbing"});
        $("#agregar_etapa").submit(function(e){
            e.preventDefault();
            alertify.confirm('Agregar Etapa', '¿Esta seguro/a de que quiere agregar esta estapa al protocolo?', function(){
                modal = cargando("Agregar Etapa", "Agregando...");
                idleTime = 0;
                
                var formdata = new FormData(document.getElementById("agregar_etapa"));
                if($('#etapa_foto')[0].files[0].type.match('image.*')){
                    var image = canvas3.toDataURL("image/jpeg");
                    formdata.append('img',image);
                }
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('id_morbido',$('#fecha_morbido').val());
                formdata.append('id_protocolo',$('#id_protocolo').val());
                document.getElementById("boton_etapa").disabled = true;
                $.ajax({
                    url: '../agregar_etapa',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            alertify.success(data.mensaje);
                            document.getElementById("boton_etapa").disabled = false;
                            $('#tabla_protocolo').DataTable().ajax.reload();
                            modal.out();
                        }
                        else{
                            document.getElementById("boton_etapa").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        document.getElementById("boton_etapa").disabled = false;
                        alertify.error('Ocurrio un error al intentar agregar la etapa');
                        modal.out();
                    }
                })
                    
                }
                    , function(){ alertify.error('La etapa no fue agregada')});

        })
    })

    function foto_protocolo(){
        if($('#etapa_foto')[0].files[0].type.match('image.*')){
            $("#lienzo_etapa").empty();
            img = new Image();
            img.onload = function(){
                if(this.width<=1920){
                    var ancho = this.width;
                    var alto = this.height;
                }
                else{
                    var ratio = this.width/1920;
                    var ancho = this.width/ratio;
                    var alto = this.height/ratio;
                }
                var canvasDiv3 = document.getElementById('lienzo_etapa');
                canvas3 = document.createElement('canvas');
                canvas3.setAttribute('width', ancho);
                canvas3.setAttribute('height', alto);
                canvas3.setAttribute('id', 'canvas3');
                canvasDiv3.appendChild(canvas3);
                if(typeof G_vmlCanvasManager != 'undefined') {
                    canvas3 = G_vmlCanvasManager.initElement(canvas);
                }
                context3 = canvas3.getContext("2d");
                context3.clearRect(0, 0, canvas3.width, canvas3.height);
                context3.drawImage(img,0,0,ancho,alto);
            };
            var URL = window.webkitURL || window.URL;
            img.src = URL.createObjectURL($('#etapa_foto')[0].files[0]);
        }
        else{
            alertify.error("No es una imagen");
            $('#etapa_foto').val("");
        }
    }

    function ver_foto_etapa(url){
        if(url != undefined){
            $("#lienzo_etapa").empty();
            img = new Image();
            var modal = cargando("Cargando Imagen", "Cargando...");
            img.onload = function(){
                if(this.width<=1920){
                    var ancho = this.width;
                    var alto = this.height;
                }
                else{
                    var ratio = this.width/1920;
                    var ancho = this.width/ratio;
                    var alto = this.height/ratio;
                }
                var canvasDiv3 = document.getElementById('lienzo_etapa');
                canvas3 = document.createElement('canvas');
                canvas3.setAttribute('width', ancho);
                canvas3.setAttribute('height', alto);
                canvas3.setAttribute('id', 'canvas3');
                canvasDiv3.appendChild(canvas3);
                if(typeof G_vmlCanvasManager != 'undefined') {
                    canvas3 = G_vmlCanvasManager.initElement(canvas);
                }
                context3 = canvas3.getContext("2d");
                context3.clearRect(0, 0, canvas3.width, canvas3.height);
                context3.drawImage(img,0,0,ancho,alto);
                modal.out();
                alertify.success("Imagen cargada correctamente");
            };

            img.onerror = function(){
                modal.out();
                alertify.error("Error al cargar imagen");
            }
            var URL = window.webkitURL || window.URL;
            img.src = "../imagen/"+$("#id_paciente").val()+"/morbido/"+$('#fecha_morbido').val()+"/patologia/"+$("#id_protocolo").val()+"/etapa/"+url+"?t="+new Date().getTime();
        }
        else{
            alertify.error("Esta etapa no tiene foto");
        }
    }
    
    function eliminar_etapa(id){
        alertify.confirm('Eliminar Etapa', '¿Esta seguro/a de que quiere eliminar esta etapa?', function(){
            idleTime = 0;
            modal = cargando("Eliminar Etapa", "Eliminando...");
            var formdata = new FormData();
            formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
            formdata.append('id_paciente',$('#id_paciente').val());
            formdata.append('id_morbido',$('#fecha_morbido').val());
            formdata.append('id_patologia_morbido',$('#id_protocolo').val());
            formdata.append('id_etapa',id);
            $.ajax({
                url: '../eliminar_etapa',
                type: 'POST',
                processData: false,
                contentType: false,
                data : formdata,
                success: function(data){
                    //console.log(respuesta.resultado);
                    //console.log(respuesta.mensaje);
                    if(data.estado=="true"){
                        alertify.success(data.mensaje);
                        $("#tabla_protocolo").DataTable().ajax.reload();
                        modal.out();
                    }
                    else{
                        alertify.error(data.mensaje);
                        modal.out();
                    }
                },
                error: function(){
                    alertify.error('Ocurrio un error al intentar eliminar esta etapa');
                    modal.out();
                }
            })
                
            }
                , function(){ alertify.error('La etapa no fue eliminada')});
    }
    (function multiple_modal() {
    $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    $(document).on('hidden.bs.modal', '.modal', function () {
        $('.modal:visible').length && $(document.body).addClass('modal-open');
    });
})()
</script>