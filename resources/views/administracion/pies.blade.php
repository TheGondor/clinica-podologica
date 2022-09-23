
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
    <li class="breadcrumb-item">Examen General</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-exclamation-circle'></i>Pies
        <small>

        </small>
    </h1>
</div>
 <div class="row">
        <div class="col-xl-12">
            <div id="panel-6" class="panel">
                <div class="panel-hdr">
                    <h2 id='tituloAccion'>
                        Pies Paciente
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Minimizar"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content p-0">
                        <form id="eliminar_pie">
                            <div class="panel-content">
                                <div class="col-lg-6 col-sm-6">
                                    <label for="hta">Fecha pies</label>
                                    <select class="custom-select mr-sm-2" id="fecha_pie" name="fecha_pie" enabled>

                                        @if ($fecha_pies->count()>0)
                                        <option value="0" selected>Seleccion fecha</option>
                                        @foreach ($fecha_pies as $fecha)
                                        <option value="{{$fecha->id}}">{{date('d/m/Y',strtotime($fecha->fecha))}}</option>
                                        @endforeach
                                        @else
                                        <option value="0">Este paciente no ha subido imagen de pie</option>
                                        @endif
                                    </select>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 mt-2">
                                    <button class="btn btn-danger mt-4" type="submit" id="boton_eliminar_pie" form="eliminar_pie" disabled>Eliminar</button>
                                  </div>
                            </div>
                        </form>
                        <div class="row">
                            <div id="lienzo_pie" class="col-12"></div>
                        </div>

                        <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 row">

                            <input type="file" id="subir_foto_derecho" oninput="foto_pie()" accept="image/png, image/jpeg" capture style="display:none">
                            <button class="btn btn-success col-xs-6 col-sm-3 col-md-2 col-lg-2 m-1" id="foto_derecho">Subir Imagen</button>
                            <button class="btn btn-secondary col-xs-6 col-sm-3 col-md-2 col-lg-2 m-1" id="reload_pie">Cargar Imagen Estandar</button>
                            <button class="btn btn-primary col-xs-6 col-sm-3 col-md-2 col-lg-2 m-1" onclick='subir_imagen("nuevo")'>Crear Nueva Imagen</button>
                            <button class="btn btn-info col-xs-6 col-sm-3 col-md-2 col-lg-2 m-1" onclick='subir_imagen("reemplazo")' id="reemplazar_pie" disabled>Actualizar Imagen Actual</button>
                            <input type="date" class="form-control col-xs-6 col-sm-3 col-md-3 col-lg-2 m-1" id="nueva_fecha_pie" oninput="foto_pie()" value="{{date('Y-m-d',time())}}">
                            <input class="form-control col-xs-4 col-sm-2 col-md-1 m-1 col-lg-1" type="color" oninput="cambiacolor(this);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container d-none">
    <div class="row">
        <div id="lienzo_etapa" class="my-auto col-12"></div>
    </div>
</div>
<div class="container d-none">
    <div class="row">
        <div id="lienzo_etapa_pop" class="my-auto col-12"></div>
    </div>
</div>

<script src="js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
<script src="js/datagrid/datatables/datatables.bundle.js"></script>
<script>

var mouseClicked = false;
var prevX = 0;
var currX = 0;
var prevY = 0;
var currY = 0;
var fillStyle = "#000000";
var fillStyle2 = "#000000";
//var globalCompositeOperation = "source-over";
var lineWidth = 2;

function cambiacolor(data){
    fillStyle = data.value;
};

//Aquí es donde vamos a insertar el código javascript para crear el lienzo
var canvasDiv = document.getElementById('lienzo');

var canvas;

function draw(dot) {
  var ctx = canvas.getContext("2d");
  ctx.beginPath();
  //ctx.globalCompositeOperation = globalCompositeOperation;
  if(dot){
    ctx.fillStyle = fillStyle;
    ctx.fillRect(currX, currY, 3, 3);
  } else {
    ctx.beginPath();
    ctx.moveTo(prevX, prevY);
    ctx.lineTo(currX, currY);
    ctx.strokeStyle = fillStyle;
    ctx.lineWidth = lineWidth;
    ctx.stroke();
  }
  ctx.closePath();
}

function handleMouseEvent(e) {
    e.preventDefault();
    if (e.type === 'mousedown') {
    prevX = currX;
    prevY = currY;
    currX = e.offsetX * canvas.width / canvas.clientWidth;
    currY = e.offsetY * canvas.height / canvas.clientHeight;
    mouseClicked = true;
    draw(true);
  }
  if (e.type === 'mouseup' || e.type === "mouseout") {
    mouseClicked = false;
  }
  if (e.type === 'mousemove' ) {
    if (mouseClicked) {
      prevX = currX;
      prevY = currY;
      currX = e.offsetX * canvas.width / canvas.clientWidth;
      currY = e.offsetY * canvas.height / canvas.clientHeight;
      draw();
    }
  }
};
$(document).ready(function(){
    $('#foto_derecho').click(function(){ $('#subir_foto_derecho').trigger('click'); });

    $("#fecha_pie").change(function(){
        var modal = cargando("Cargando Imagen", "Cargando...");
        idleTime = 0;
        img = new Image();
        img.onload = function(){
            $("#lienzo_pie").empty();
            if(this.width<=1920){
                var ancho = this.width;
                var alto = this.height;
            }
            else{
                var ratio = this.width/1920;
                var ancho = this.width/ratio;
                var alto = this.height/ratio;
            }
            canvasDiv = document.getElementById('lienzo_pie');
            canvas = document.createElement('canvas');
            canvas.setAttribute('width', ancho);
            canvas.setAttribute('height', alto);
            canvas.setAttribute('id', 'canvas3');
            canvas.addEventListener("mousemove", handleMouseEvent);
            canvas.addEventListener("mousedown", handleMouseEvent);
            canvas.addEventListener("mouseup", handleMouseEvent);
            canvas.addEventListener("mouseout", handleMouseEvent);
            canvasDiv.appendChild(canvas);
            if(typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            context = canvas.getContext("2d");
            context.clearRect(0, 0, canvas.width, canvas.height);
            context.drawImage(img,0,0,ancho,alto);
            modal.out();
            var date = $("#fecha_pie option[value='" +$("#fecha_pie").val()+"']").html();
            //console.log(date);
            var newdate = date.split("/").reverse().join("-");

            $("#nueva_fecha_pie").val(newdate);
            document.getElementById("reemplazar_pie").disabled = false;
            $("canvas").css("width", "100% ");
            $("canvas").css("height", "auto");
            document.getElementById("boton_eliminar_pie").disabled = false;
            document.getElementById("reemplazar_pie").disabled = false;
            //console.log(img.src);
        };

        img.onerror = function(){
            modal.out();
            alertify.error("Error al cargar la imagen");
        }
        var URL = window.webkitURL || window.URL;
        img.src = "/imagen/"+$("#id_paciente").val()+"/pie/"+$("#fecha_pie").val()+"?t="+new Date().getTime();
    })

    $("#reload_pie").click(function(){
        modal = cargando("Cargando imagen", "Cargando...")
        $("#lienzo_pie").empty();
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
            canvasDiv = document.getElementById('lienzo_pie');
            canvas = document.createElement('canvas');
            canvas.setAttribute('width', ancho);
            canvas.setAttribute('height', alto);
            canvas.setAttribute('id', 'canvas3');
            canvas.addEventListener("mousemove", handleMouseEvent);
            canvas.addEventListener("mousedown", handleMouseEvent);
            canvas.addEventListener("mouseup", handleMouseEvent);
            canvas.addEventListener("mouseout", handleMouseEvent);
            canvasDiv.appendChild(canvas);
            if(typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            context = canvas.getContext("2d");
            context.clearRect(0, 0, canvas.width, canvas.height);
            context.drawImage(img,0,0,ancho,alto);
            $("canvas").css("width", "100%");
            $("canvas").css("height", "auto");
            modal.out()
        };
        var URL = window.webkitURL || window.URL;
        img.src = "../img/pies.png";

      });

   $("#eliminar_pie").submit(function(e){
    e.preventDefault();
    var swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger mr-2"
			},
			buttonsStyling: false
		});
		swalWithBootstrapButtons
		.fire({
			title: "Esta seguro/a de eliminar pie?",
			text: "No se podran revertir los cambios!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, eliminar!",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true
		})
		.then(function(result) {
			if (result.value) {
				modal = cargando("Eliminar Imagen Pie", "Eliminando...");
                var formdata = new FormData(document.getElementById("eliminar_pie"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                var eliminar = $('#fecha_pie').val();
                document.getElementById("boton_eliminar_pie").disabled = true;
                $.ajax({
                    url: '../eliminar_pie',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            swalWithBootstrapButtons.fire(
                                "Eliminado!",
                                data.mensaje,
                                "success"
                            );
                            $("#fecha_pie option[value='"+eliminar+"']").remove();
                            var largo = document.getElementById("fecha_pie").length;
                            if(largo == 0){
                                $("#fecha_pie").append('<option value="0">No existen imagenes</option>');


                            }
                            document.getElementById("boton_eliminar_pie").disabled = true;
                            document.getElementById("reemplazar_pie").disabled = true;
                            $("#lienzo_pie").empty();
                            modal.out();
                        }
                        else{
                            document.getElementById("boton_eliminar_pie").disabled = false;
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: data.mensaje,
                            })
                            modal.out();
                        }
                    },
                    error: function(){
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: "Ocurrio un error al intentar eliminar la imagen",
                        })
                        document.getElementById("boton_eliminar_pie").disabled = false;
                        modal.out();
                    }
                })
			} else if (
		// Read more about handling dismissals
		result.dismiss === Swal.DismissReason.cancel
		) {
				swalWithBootstrapButtons.fire(
					"Cancelado",
					"El pie no fue eliminado",
					"error"
					);
			}
		});
   })
})

function subir_imagen(info){
    if(info == "nuevo"){
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons
        .fire({
            title: "Esta seguro/a de subir pie?",
            text: "No se podran revertir los cambios!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, subir!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        })
        .then(function(result) {
            if (result.value) {
                modal = cargando("Subir Imagen Pie", "Subiendo...");
                var formdata = new FormData(document.getElementById("eliminar_pie"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                var eliminar = $('#fecha_pie').val();
                idleTime = 0;
                var image = canvas.toDataURL("image/jpeg");
                var formdata = new FormData();
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('img',image);
                formdata.append('id_foto',0);
                formdata.append('fecha',$("#nueva_fecha_pie").val());
                $.ajax({
                    url: '../upload_image',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        //console.log(respuesta.mensaje);
                        if(data.estado=="true"){
                            modal.out();
                            swalWithBootstrapButtons.fire(
                                "Subida!",
                                data.mensaje,
                                "success"
                            );

                            $("#fecha_pie").append('<option value="'+data.pie['id']+'">'+data.pie['fecha2']+'</option>');
                            $("#fecha_pie").val(data.pie['id']);
                            document.getElementById("boton_eliminar_pie").disabled = false;
                            document.getElementById("reemplazar_pie").disabled = false;
                        }
                        else{
                            modal.out();
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: data.mensaje,
                            })

                        }
                    },
                    error: function(){
                        modal.out();
                        Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: "Ocurrio un error al intentar subir la imagen",
                            })

                    }
                })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    "Cancelado",
                    "El pie no fue subido",
                    "error"
                );
            }
        });
    }
    else{
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons
        .fire({
            title: "Esta seguro/a de reemplazar este pie?",
            text: "No se podran revertir los cambios!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, reemplazar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        })
        .then(function(result) {
            if (result.value) {
                modal = cargando("Reemplazar Imagen Pie", "Reemplazando...");
                var formdata = new FormData(document.getElementById("eliminar_pie"));
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                var eliminar = $('#fecha_pie').val();
                idleTime = 0;
                var image = canvas.toDataURL("image/jpeg");
                var formdata = new FormData();
                formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                formdata.append('id_paciente',$('#id_paciente').val());
                formdata.append('img',image);
                formdata.append('id_foto',$("#fecha_pie").val());
                formdata.append('fecha',$("#nueva_fecha_pie").val());
                $.ajax({
                        url: '../upload_image',
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data : formdata,
                        success: function(data){
                            //console.log(respuesta.resultado);
                            //console.log(respuesta.mensaje);
                            if(data.estado=="true"){
                                modal.out();
                                swalWithBootstrapButtons.fire(
                                    "Reemplazada!",
                                    data.mensaje,
                                    "success"
                                );
                                $("#fecha_pie option[value='"+data.pie['id']+"']").html(data.pie['fecha2']);
                            }
                            else{
                                modal.out();
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: data.mensaje,
                                })
                            }
                        },
                        error: function(){
                            modal.out();
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: "Ocurrio un error al intentar reemplazar la imagen",
                            })
                        }
                    })
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    "Cancelado",
                    "El pie no fue reemplazado",
                    "error"
                );
            }
        });
    }
}

function foto_pie(){
    if($('#subir_foto_derecho')[0].files[0].type.match('image.*')){
        $("#lienzo_pie").empty();
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
            canvasDiv = document.getElementById('lienzo_pie');
            canvas = document.createElement('canvas');
            canvas.setAttribute('width', ancho);
            canvas.setAttribute('height', alto);
            canvas.setAttribute('id', 'canvas3');
            canvas.addEventListener("mousemove", handleMouseEvent);
            canvas.addEventListener("mousedown", handleMouseEvent);
            canvas.addEventListener("mouseup", handleMouseEvent);
            canvas.addEventListener("mouseout", handleMouseEvent);
            canvasDiv.appendChild(canvas);
            if(typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            context = canvas.getContext("2d");
            context.clearRect(0, 0, canvas.width, canvas.height);
            context.drawImage(img,0,0,ancho,alto);
            $("canvas").css("width", "100%");
            $("canvas").css("height", "auto");
        };
        var URL = window.webkitURL || window.URL;
        img.src = URL.createObjectURL($('#subir_foto_derecho')[0].files[0]);

    }
    else{
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: "El archivo seleccionado no es una imagen",
        })
        $('#subir_foto_derecho').val("");
        $("#lienzo_pie").empty();
    }
}

</script>
