
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
	<li class="breadcrumb-item">Pacientes</li>
	<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-exclamation-circle'></i>Pacientes
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
					<form id="editar_admin">
						<input type="hidden" name="metodo" value="Actualizar" id="metodo">
						<div class="panel-content">
						<div class="form-row">
						<div class="col-lg-4 col-sm-12">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre" required>
						</div>
						<div class="col-lg-4 col-sm-12">
							<label for="nombre">Apellido</label>
							<input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese Apellido" required>
						</div>
						<div class="col-lg-4 col-sm-12">
							<label for="nacimiento">Fecha Nacimiento</label>
							<input type="date" class="form-control" name="nacimiento" id="nacimiento"  required>
						</div>
						</div>
						<div class="form-row">
						<div class="col-lg-4 col-sm-8">
							<label for="domicilio">Domicilio</label>
							<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Ingrese Domicilio" required>
						</div>
						<div class="col-lg-4 col-sm-4">
							<label for="domicilio_paciente">Region</label>
							<select id="id_region" name="id_region" class="form-control" onchange="llenarcomunas()" required>
								<option value="0">Seleccione Region</option>
								@foreach ($regiones as $region)
									<option value="{{$region->id}}">{{$region->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-4 col-sm-4">
							<label for="domicilio_paciente">Comuna</label>
							<select id="id_commune" name="id_commune" class="form-control" required>
								<option value="0">Seleccione Comuna</option>
							</select>
						</div>

						</div>
						<div class="form-row">
						<div class="col-lg-3 col-sm-8">
							<label for="rut_paciente">Rut</label>
							<div class="input-group">
							<input type="text" class="form-control" name="rut" id="rut" oninput="checkRut(this)" placeholder="Ingrese Rut" required>
							</div>
						</div>
						<div class="col-lg-3 col-sm-8">
							<label for="telefono">Telefono</label>
							<div class="input-group">
							<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese telefono" required>
							</div>
						</div>
							<div class="col-lg-3 col-sm-12">
							<label for="estado_civil">E.Civil</label>
							<input id="nombre_estado" name="nombre_estado" class="form-control" list="estados" value="" required>
							<datalist id="estados">
								@isset($estados)
							@foreach ($estados as $estado)
								<option value="{{$estado->nombre_estado}}">{{$estado->nombre_estado}}</option>
							@endforeach
							@endisset
							</datalist>

						</div>
						<div class="col-lg-3 col-sm-12">
							<label for="actividad_paciente">Actividad</label>
							<div class="input-group">
							<input id="nombre_actividad" name="nombre_actividad" list="actividades" value="" class="form-control" required>
							<datalist id="actividades">
								@isset($actividades)
								@foreach ($actividades as $actividad)
								<option value="{{$actividad->nombre_actividad}}">{{$actividad->nombre_actividad}}</option>
								@endforeach
								@endisset
							</datalist>

							</div>
                      	</div>
						</div>

						</div>
						<div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row">
							<button id='btnAccion' class="btn btn-primary ml-auto" type="submit">Actualizar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2>
					Pacientes<span class="fw-300"><i>Tabla</i></span>
				</h2>
				<div class="panel-toolbar">
					<a onclick='nuevo()' class='btn btn-sm btn-outline-success mr-2' title='Ver Imagen'><i class="fal fa-plus-square"></i> Nuevo</a>
					<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<!-- datatable start -->
					<table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
						<thead>
							<tr>
							<th>Rut</th>
							<th>Nombre</th>
							<th>Direccion</th>
							<th>Telefono</th>
							<th>Accion</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
							<th>Rut</th>
							<th>Nombre</th>
							<th>Direccion</th>
							<th>Telefono</th>
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
						url: "../ver_pacientes",
						type: 'POST',
					},
					columns:[
						{
						data: 'rut',
						name: 'rut'

						},
						{
						data: 'nombre',
						name: 'nombre'
						},
						{
						data: 'direccion',
						name: 'direccion'
						},
						{
							data: 'telefono',
							name: 'telefono'
						},
						{
							data: 'accion',
							name: 'accion',
							className: 'text-center px-0 mx-1'
						}
					],
					drawCallback: function(settings) {
						var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
						pagination.toggle(this.api().page.info().pages > 1);
					}
				});

                $(".active").removeClass('active');
				$("#menu_pacientes").addClass('active');


				$("#editar_admin").submit(function(e){
					e.preventDefault();
					if($("#metodo").val() == "Guardar")
					{
                        modal = cargando("Guardando Paciente", "Guardando...");
						var check = "true";
					}
					else{
						if($("#metodo").val()=="Actualizar"){
                            modal = cargando("Actualizando Paciente", "Actualizando...");
							var check = "true";
						}
						else{
							var check = "false";
						}
					}
					if(check == "true"){
						var formdata = new FormData();
						formdata.append('nombre',$("#nombre").val());
						formdata.append('apellido',$("#apellido").val());
						formdata.append('domicilio',$("#domicilio").val());
						formdata.append('nacimiento',$("#nacimiento").val());
						formdata.append('rut',$("#rut").val());
						formdata.append('telefono',$("#telefono").val());
						formdata.append('id_commune',$("#id_commune").val());
						formdata.append('nombre_actividad',$("#nombre_actividad").val());
						formdata.append('nombre_estado',$("#nombre_estado").val());
						if($("#metodo").val()=="Actualizar"){
							formdata.append('_method','PUT');
							formdata.append('id_paciente', $("#id_paciente").val());
						}
						else{
							formdata.append('_method','POST');
						}

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							url: 'paciente',
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
							var rowToScrollTo = document.getElementById('editar_admin');
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
		$("#nombre").val('');
		$("#apellido").val('');
		$("#rut").val('');
		$("#telefono").val('');
		$("#domicilio").val('');
		$("#nombre_actividad").val('');
		$("#nombre_estado").val('');
		$("#nacimiento").val('');
		$("#id_region").val('0');
		$("#id_commune").val('0');
		document.getElementById("id_commune").disabled = true;
		$("#panel-6").removeClass('d-none');
	}
	function editar(id){
		$("#id_paciente").val(id);
        modal = cargando("Cargando Paciente", "Cargando...");
		$("#metodo").val('Actualizar');
		$.ajax({
			url: 'paciente/'+id,
			type: 'GET',
			processData: false,
			contentType: false,
			success: function(data){
			//console.log(respuesta.resultado);
			//console.log(respuesta.mensaje);
			if(data.estado=="true"){
                modal.out();
				$("#tituloAccion").html('Editar');
				$("#btnAccion").html('Actualizar');
				$("#nombre").val(data.paciente.nombre);
				$("#nacimiento").val(data.paciente.nacimiento);
				$("#apellido").val(data.paciente.apellido);
				$("#email").val(data.paciente.email);
				$("#rut").val(data.paciente.rut);
				$("#telefono").val(data.paciente.telefono);
				$("#nombre_estado").val(data.paciente.estado.nombre_estado);
				$("#nombre_actividad").val(data.paciente.actividad.nombre_actividad);
				$("#domicilio").val(data.paciente.domicilio);
				$("#id_region").val(data.paciente.commune.region.id);
				llenarcomunas(data.paciente.commune.id);
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
                modal = cargando("Elimiando Paciente", "Elimiando...");
				var formdata = new FormData();
				formdata.append('_method','DELETE');
				formdata.append('id',id);
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: 'paciente',
					processData: false,
					contentType: false,
					type: 'POST',
					data : formdata,
					success: function(data){
			//console.log(respuesta.resultado);
			//console.log(respuesta.mensaje);
			if(data.estado=="true"){
                modal.out();
                if(id == $("#id_paciente").val()){
                    $("#menu_paciente").hide();
                }
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
					"El paciente no fue eliminado",
					"error"
					);
			}
		});
	}

	function llenarcomunas(id_comuna){
		document.getElementById("id_commune").disabled = true;
		$.ajax({
			url: 'ver_comunas',
			type: 'POST',
			data: {
				id: $("#id_region").val(),
				_token :  $('meta[name="csrf-token"]').attr('content')
			},
			dataType : 'json',
			success: function(data,status,xhr){
				$("#id_commune").empty();
				$("#id_commune").append('<option selected value="0">Seleccione Comuna</option>');
				data.forEach(obj => {
					$("#id_commune").append('<option value="'+obj.id+'">'+obj.name+'</option>');
				});
				document.getElementById("id_commune").disabled = false;
				document.getElementById("id_commune").readOnly = false;
				if(id_comuna != undefined){
					$("#id_commune").val(id_comuna);
				}
			}
		});
    }

    function ver(id){
        $("#id_paciente").val(id)
        $( "#js-page-content" ).load( "/admin_paciente/"+id, function( response, status, xhr ) {
            if ( status == "error" ) {
                window.location.replace("/login");
            }
        });

    }
</script>

