<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
	<li class="breadcrumb-item">Antecedentes Morbidos</li>
	<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-exclamation-circle'></i>Patologias
		<small>

		</small>
	</h1>
</div>
<div class="row">
	<div class="col-xl-12">
        <div id="panel-6" class="panel d-none">
			<div class="panel-hdr">
				<h2 id='tituloAccion'>
					Editar
				</h2>
				<div class="panel-toolbar">
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Minimizar"></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content p-0">
					<form id="editar_patologia">
                        <input type="hidden" name="metodo" value="Actualizar" id="metodo">
                        <input type="hidden" name="id_patologia" value="0" id="id_patologia">
                        <div class="panel-content">
						<div class="form-row">
                            <div class="col-md-12 col-sm-12">
                                <label for="nombre_paciente">Agrega Patologia</label>
                                <input type="text" list="patologias" class="form-control" id="nombre_patologia" name="nombre_patologia" required>
                                <datalist id="patologias">
                                    <option value="">Selecciona Patologia</option>
                                        @isset($patologias)
                                        @foreach ($patologias as $enf)
                                        <option value="{{$enf->id}}">{{$enf->nombre_patologia}}</option>
                                        @endforeach
                                        @endisset
                                </datalist>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="nombre_paciente">Comentario</label>
                                <input type="text" class="form-control" id="comentario" name="comentario">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="nombre_paciente">Tecnica</label>
                                <input type="text" class="form-control" id="tecnica" name="tecnica">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="validationDefault01">Protocolo</label>
                                <div class="panel-content">
                                    <div class="js-summernote" id="summernote"></div>
                                </div>
                            </div>
						</div>
						<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row">
							<button id='btnAccion' class="btn btn-primary ml-auto" type="submit">Actualizar</button>
                        </div>
                        </div>
					</form>
				</div>
			</div>
		</div>
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2>
					Patologias<span class="fw-300"><i>Lista</i></span>
				</h2>
				<div class="panel-toolbar">
					<a onclick='nuevo()' class='btn btn-sm btn-outline-success mr-2' title='Nuevo'><i class="fal fa-plus-square"></i> Nuevo</a>
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<!-- datatable start -->
					<table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
						<thead>
							<tr>
                            <th>Nombre Patologia</th>
                            <th>Técnica</th>
                            <th>Comentario</th>
							<th>Accion</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<th>Nombre Patologia</th>
                            <th>Técnica</th>
                            <th>Comentario</th>
							<th>Accion</th>
							</tr>
						</tfoot>
					</table>
					<!-- datatable end -->
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

<script>
	$(document).ready(function()
	{
        $("#nombre_patologia").on('input', function(){
            var formdata = new FormData(document.getElementById("editar_patologia"));
            formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
            formdata.append('nombre_patologia',$('#nombre_patologia').val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'getProtocolo',
                processData: false,
                contentType: false,
                type: 'POST',
                data : formdata,
                success: function(data){
                    if(data.estado=="true"){
                        $('#summernote').summernote('code',data.protocolo);
                    }
                }
             })
        })

        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function(files) {
                // upload image to server and create imgNode...
                var fotos = foto(files);
                }
            },
            height: 300
        });
				// initialize datatable
				$('#dt-basic-example').DataTable({
					processing: true,
					serverSide: true,
					responsive: true,
                    lengthChange: false,
					ajax:{
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						url: "../ver_patologias",
                        type: 'POST',
                        data: {id_paciente: $("#id_paciente").val()}
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
						data: 'comentario',
						name: 'comentario'

						},
						{
							data: 'accion',
							name: 'accion',
							className: 'text-center'
						}
					],
					drawCallback: function(settings) {
						var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
						pagination.toggle(this.api().page.info().pages > 1);
					}
				});

                $(".active").removeClass('active');
                $("#menu_paciente").addClass('active');
                $("#menu_morbido").addClass('active open');
                $("#menu_patologia").addClass('active');


				$("#editar_patologia").submit(function(e){
					e.preventDefault();
					if($("#metodo").val() == "Guardar")
					{
                        modal = cargando("Guardando Patologia", "Guardando...");
						var check = "true";
					}
					else{
						if($("#metodo").val()=="Actualizar"){
                            modal = cargando("Actualizando Patologia", "Actualizando...");
							var check = "true";
						}
						else{
							var check = "false";
						}
					}
					if(check == "true"){
						var formdata = new FormData(document.getElementById("editar_patologia"));
                        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                        formdata.append('id_paciente',$('#id_paciente').val());
                        formdata.append('protocolo', $('#summernote').summernote("code"));
						if($("#metodo").val()=="Actualizar"){
							formdata.append('_method','PUT');
                            formdata.append('id_paciente', $("#id_paciente").val());
                            formdata.append('id_patologia', $("#id_patologia").val());
						}
						else{
							formdata.append('_method','POST');
						}

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							url: 'patologia',
							processData: false,
							contentType: false,
							type: 'POST',
							data : formdata,
							success: function(data){
						//console.log(respuesta.resultado);
						//console.log(respuesta.mensaje);
						if(data.estado=="true"){
                            modal.out();
							Swal.fire({
								type: 'success',
								title: data.mensaje
							});
							$('#dt-basic-example').DataTable().ajax.reload();
							var rowToScrollTo = document.getElementById('editar_patologia');
							$("#panel-1").removeClass('panel-collapsed');
							$("#panel-6").addClass('d-none');
							document.documentElement.scrollTop = rowToScrollTo.offsetTop;
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
							text: "Error al actualizar los datos",
						})
					}
				})
					}

				});
			});

	function nuevo(){
		var selectedPanel = $("#panel-6").closest('.panel');
		selectedPanel.children('.panel-container').collapse('show')
		.on('show.bs.collapse', function() {
			selectedPanel.removeClass("panel-collapsed");
        });
        $("#tituloAccion").html('Nuevo');
		$("#btnAccion").html('Guardar');
		$("#metodo").val('Guardar');
		$("#nombre_patologia").val("");
        $("#comentario").val("");
        $("#tecnica").val("");
        $('#summernote').summernote('reset');
		$("#panel-6").removeClass('d-none');
	}
	function editar(id){
		$("#id_patologia").val(id);
        modal = cargando("Cargando Patologia", "Cargando...");
		$("#metodo").val('Actualizar');
		$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url: 'patologia/'+id+'/paciente/'+$("#id_paciente").val(),
            type: 'GET',
			processData: true,
			contentType: false,
			success: function(data){
			//console.log(respuesta.resultado);
			//console.log(respuesta.mensaje);
			if(data.estado=="true"){
                modal.out();
				$("#tituloAccion").html('Editar');
				$("#btnAccion").html('Actualizar');
				$("#nombre_patologia").val(data.patologia.patologia['nombre_patologia']);
                $("#comentario").val(data.patologia['comentario']);
                $("#tecnica").val(data.patologia['tecnica']);
                $('#summernote').summernote('code',data.patologia.protocolo);
				$("#panel-6").removeClass('d-none');

				var selectedPanel = $("#panel-6").closest('.panel');
				selectedPanel.children('.panel-container').collapse('show')
				.on('show.bs.collapse', function() {
					selectedPanel.removeClass("panel-collapsed");
				});
				document.documentElement.scrollTop = 0;
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
				text: "Ocurrio un error al cargar los datos",
			});
		}
	    })
    }


	function eliminar(id){
		var swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: "btn btn-primary",
				cancelButton: "btn btn-danger mr-2"
			},
			buttonsStyling: false
		});
		swalWithBootstrapButtons
		.fire({
			title: "Esta seguro?",
			text: "No se podran revertir los cambios!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Si, eliminar!",
			cancelButtonText: "No, cancelar!",
			reverseButtons: true
		})
		.then(function(result) {
			if (result.value) {
                modal = cargando("Elimiando Patologia", "Elimiando...");
				var formdata = new FormData();
				formdata.append('_method','DELETE');
                formdata.append('id_patologia',id);
                formdata.append('id_paciente',$("#id_paciente").val());
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: 'patologia',
					processData: false,
					contentType: false,
					type: 'POST',
					data : formdata,
					success: function(data){
			//console.log(respuesta.resultado);
			//console.log(respuesta.mensaje);
			if(data.estado=="true"){
                modal.out();
                $("#panel-1").removeClass('panel-collapsed');
				$("#panel-6").addClass('d-none');
				swalWithBootstrapButtons.fire(
					"Eliminado!",
					data.mensaje,
					"success"
					);
				$('#dt-basic-example').DataTable().ajax.reload();
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
			swalWithBootstrapButtons.fire(
				"Error",
				"Ocurrio un error al intentar eliminar los datos",
				"error"
				);
			modal.out();
		}
	})

			} else if (
		// Read more about handling dismissals
		result.dismiss === Swal.DismissReason.cancel
		) {
				swalWithBootstrapButtons.fire(
					"Cancelado",
					"La patología del paciente no fue eliminada",
					"error"
					);
			}
		});
	}

    function foto(file){
        if(file[0].type.match('image.*')){
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
                var formdata = new FormData();
                formdata.append('img',canvas3.toDataURL("image/jpeg"));
                //console.log(canvas3.toDataURL("image/jpeg"));
                $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: 'upload_foto',
					processData: false,
					contentType: false,
					type: 'POST',
					data : formdata,
                    success: function(data){
                        //console.log(respuesta.resultado);
                        $img = $('<img>').attr({ src: data.url })
                        $('#summernote').summernote('insertNode', $img[0]);
                    },
                    error: function(){
                        swalWithBootstrapButtons.fire(
                            "Error",
                            "Ocurrio un error al intentar eliminar los datos",
                            "error"
                            );
                        modal.out();
                    }
                })
            };
            var URL = window.webkitURL || window.URL;
            img.src = URL.createObjectURL(file[0]);
        }
        else{
            Swal.fire({
                type: "error",
                title: "Oops...",
                text: "El archivo seleccionado no corresponde a una imagen"
              });
        }
    }
</script>

