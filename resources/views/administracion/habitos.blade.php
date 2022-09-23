

<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
	<li class="breadcrumb-item">Antecedentes Morbidos</li>
	<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-exclamation-circle'></i>Habitos
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
					<form id="editar_habito">
                        <input type="hidden" name="metodo" value="Actualizar" id="metodo">
                        <input type="hidden" name="id_habito" value="0" id="id_habito">
                        <div class="panel-content">
						<div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <label for="nombre_paciente">Agrega Habito</label>
                                <input type="text" list="habitos" class="form-control" id="nombre_habito" name="nombre_habito" required>
                                <datalist id="habitos">
                                    <option value="">Selecciona Habito</option>
                                        @isset($habitos)
                                        @foreach ($habitos as $enf)
                                        <option value="{{$enf->id}}">{{$enf->nombre_habito}}</option>
                                        @endforeach
                                        @endisset
                                </datalist>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="nombre_paciente">Comentario</label>
                                <input type="text" class="form-control" id="comentario" name="comentario">
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
					Habitoes<span class="fw-300"><i>Lista</i></span>
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
                            <th>Nombre Habito</th>
                            <th>Comentario</th>
							<th>Accion</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<th>Nombre Habito</th>
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
						url: "../ver_habitos",
                        type: 'POST',
                        data: {id_paciente: $("#id_paciente").val()}
					},
					columns:[
						{
						data: 'nombre_habito',
						name: 'nombre_habito'

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
                $("#menu_habito").addClass('active');


				$("#editar_habito").submit(function(e){
					e.preventDefault();
					if($("#metodo").val() == "Guardar")
					{
                        modal = cargando("Guardando Habito", "Guardando...");
						var check = "true";
					}
					else{
						if($("#metodo").val()=="Actualizar"){
                            modal = cargando("Actualizando Habito", "Actualizando...");
							var check = "true";
						}
						else{
							var check = "false";
						}
					}
					if(check == "true"){
						var formdata = new FormData(document.getElementById("editar_habito"));
                        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                        formdata.append('id_paciente',$('#id_paciente').val());
                        formdata.append('id_habito',$('#fecha_habito').val());
						if($("#metodo").val()=="Actualizar"){
							formdata.append('_method','PUT');
						}
						else{
							formdata.append('_method','POST');
						}

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							url: 'habito',
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
							var rowToScrollTo = document.getElementById('editar_habito');
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
		$("#nombre_habito").val("");
        $("#comentario").val("");
        document.getElementById("nombre_habito").disabled = false;
		$("#panel-6").removeClass('d-none');
	}
	function editar(id){
		$("#id_habito").val(id);
        modal = cargando("Cargando Habito", "Cargando...");
		$("#metodo").val('Actualizar');
		$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url: 'habito/'+id+'/paciente/'+$("#id_paciente").val(),
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
				$("#nombre_habito").val(data.habito.habito['nombre_habito']);
                $("#comentario").val(data.habito['comentario']);
                document.getElementById("nombre_habito").disabled = true;
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
                modal = cargando("Eliminando Habito", "Eliminando...");
				var formdata = new FormData();
				formdata.append('_method','DELETE');
                formdata.append('id_habito',id);
                formdata.append('id_paciente',$("#id_paciente").val());
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: 'habito',
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
					"El habito del paciente no fue eliminado",
					"error"
					);
			}
		});
	}

</script>

