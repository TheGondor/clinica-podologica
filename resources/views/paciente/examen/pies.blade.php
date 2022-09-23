<div class="card-body bg-modal">
    <form class="row" id="eliminar_pie">
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
          @if ($fecha_pies->count()>0)
          <div class="col-lg-6 col-sm-6 mt-2">
            <button class="btn btn-danger mt-4" type="submit" id="boton_eliminar_pie" form="eliminar_pie">Eliminar</button>
          </div>
          @else
          <div class="col-lg-6 col-sm-6 mt-2">
            <button class="btn btn-danger mt-4" type="submit" id="boton_eliminar_pie" form="eliminar_pie" disabled>Eliminar</button>
          </div>
          @endif
    </form>
    <div class="container mt-2">
        <div class="row">
            <div id="lienzo_pie" class="col-12"></div>
        </div>
        <div class="row mt-2">
            <input type="file" id="subir_foto_derecho" oninput="foto_pie()" accept="image/png, image/jpeg" capture style="display:none">
            <button class="btn btn-success col-sm-4 col-md-2 mx-1" id="foto_derecho">Subir Foto</button>
            <button class="btn btn-secondary col-sm-4 col-md-2 mx-1" id="reload_pie">Cargar Foto Estandar</button>
            <button class="btn btn-primary col-sm-4 col-md-2 mx-1" onclick='subir_imagen("nuevo")'>Guardar Nuevo</button>
            <button class="btn btn-secondary col-sm-4 col-md-2 mx-1" onclick='subir_imagen("reemplazo")' id="reemplazar_pie" disabled>Reemplazar Actual</button>
            <input type="date" class="form-control col-sm-4 col-md-2 mx-1" id="nueva_fecha_pie" oninput="foto_pie()" value="{{date('Y-m-d',time())}}">
            <input class="form-control col-sm-2 col-md-1 mx-1" type="color" oninput="cambiacolor(this);">
        </div>

    </div>
</div>
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
                alertify.success("Imagen cargada con exito");
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
            };
            var URL = window.webkitURL || window.URL;
            img.src = "../img/pies.png";

  		});

       $("#eliminar_pie").submit(function(e){
        e.preventDefault();
            alertify.confirm('Eliminar Imagen Pie', '¿Esta seguro/a de que quiere eliminar esta imagen?', function(){
                idleTime = 0;
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
                            alertify.success(data.mensaje);
                            $("#fecha_pie option[value='"+eliminar+"']").remove();
                            var largo = document.getElementById("fecha_pie").length;
                            if(largo == 0){
                                $("#fecha_pie").append('<option value="0">No existen imagenes</option>');

                                document.getElementById("boton_eliminar_pie").disabled = true;
                                document.getElementById("reemplazar_pie").disabled = false;
                            }
                            else{
                                document.getElementById("boton_eliminar_pie").disabled = false;
                            }
                            $("#lienzo_pie").empty();
                            modal.out();
                        }
                        else{
                            document.getElementById("boton_eliminar_pie").disabled = false;
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        alertify.error('Ocurrio un error al intentar eliminar la imagen')
                        document.getElementById("boton_eliminar_pie").disabled = false;
                        modal.out();
                    }
                })

                }
                    , function(){ alertify.error('La iamgen no fue eliminada')});
       })


    })

    function subir_imagen(info){
            if(info == "nuevo"){
                alertify.confirm('Subir imagen', '¿Esta seguro/a de que quiere subir esta imagen?', function(){
                modal = cargando("Subir Imagen", "Subiendo...");
                idleTime = 0;
                var canvas = getElementById(canvas3);
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
                            alertify.success(data.mensaje);
                            modal.out();
                            $("#fecha_pie").append('<option value="'+data.pie['id']+'">'+data.pie['fecha2']+'</option>');
                            $("#fecha_pie").val(data.pie['id']);
                            document.getElementById("boton_eliminar_pie").disabled = false;
                            document.getElementById("reemplazar_pie").disabled = false;
                        }
                        else{
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        alertify.error('Ocurrio un error al intentar subir la imagen');
                        modal.out();
                    }
                })

                }
                    , function(){ alertify.error('La imagen no fue subida')});
            }
            else{
                alertify.confirm('Reemplazar imagen', '¿Esta seguro/a de que quiere subir esta imagen?', function(){
                modal = cargando("Reemplazar Imagen", "Reemplazando...");
                idleTime = 0;
                var canvas = getElementById(canvas3);
                var image = canvas.toDataURL();
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
                            alertify.success(data.mensaje);
                            $("#fecha_pie option[value='"+data.pie['id']+"']").html(data.pie['fecha2']);
                            modal.out();
                        }
                        else{
                            alertify.error(data.mensaje);
                            modal.out();
                        }
                    },
                    error: function(){
                        alertify.error('Ocurrio un error al intentar subir la imagen');
                        modal.out();
                    }
                })

                }
                    , function(){ alertify.error('La imagen no fue subida')});
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
            };
            var URL = window.webkitURL || window.URL;
            img.src = URL.createObjectURL($('#subir_foto_derecho')[0].files[0]);

        }
        else{
            alertify.error("El archivo seleccionado no es una imagen");
            $('#subir_foto_derecho').val("");
            $("#lienzo_pie").empty();
        }
    }
</script>
