
<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
	<li class="breadcrumb-item">Paciente</li>
	<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-exclamation-circle'></i>{{$Paciente->nombre}}
		<small>

		</small>
	</h1>
</div>
<div class="row">
	<div class="col-xl-12">
		<div id="panel-6" class="panel">
			<div class="panel-hdr">
				<h2 id='tituloAccion'>
					Antecedentes Personales
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
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre" value="{{$Paciente->nombre}}" required>
						</div>
						<div class="col-lg-4 col-sm-12">
							<label for="nombre">Apellido</label>
							<input type="text" class="form-control" name="apellido" id="apellido" value="{{$Paciente->apellido}}"  placeholder="Ingrese Apellido" required>
						</div>
						<div class="col-lg-4 col-sm-12">
							<label for="nacimiento">Fecha Nacimiento</label>
							<input type="date" class="form-control" name="nacimiento" id="nacimiento" value="{{$Paciente->nacimiento}}"   required>
						</div>
						</div>
						<div class="form-row">
						<div class="col-lg-4 col-sm-8">
							<label for="domicilio">Domicilio</label>
							<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Ingrese Domicilio" value="{{$Paciente->domicilio}}"  required>
						</div>
						<div class="col-lg-4 col-sm-4">
                            <label for="domicilio_paciente">Region</label>
							<select id="id_region" name="id_region" class="form-control" onchange="llenarcomunas()" required>
								<option value="0">Seleccione Region</option>
                                @foreach ($regiones as $region)
                                @if ($region->id == $Paciente->commune->region->id)
                                <option value="{{$region->id}}" selected>{{$region->name}}</option>
                                @else
                                <option value="{{$region->id}}">{{$region->name}}</option>
                                @endif
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
							<input type="text" class="form-control" name="rut" id="rut" oninput="checkRut(this)" placeholder="Ingrese Rut" value="{{$Paciente->rut}}"  required>
							</div>
						</div>
						<div class="col-lg-3 col-sm-8">
							<label for="telefono">Telefono</label>
							<div class="input-group">
							<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese telefono" value="{{$Paciente->telefono}}"  required>
							</div>
						</div>
							<div class="col-lg-3 col-sm-12">
							<label for="estado_civil">E.Civil</label>
							<input id="nombre_estado" name="nombre_estado" class="form-control" list="estados" value="{{$Paciente->estado->nombre_estado}}"  required>
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
							<input id="nombre_actividad" name="nombre_actividad" list="actividades" value="{{$Paciente->actividad->nombre_actividad}}"  class="form-control" required>
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

                $(".active").removeClass('active');
                $("#menu_personales").addClass('active');
                $("#menu_paciente").addClass('active open');
                llenarcomunas({{$Paciente->commune->id}});
                $("#menu_nombre_paciente").html("{{$Paciente->nombre}}");
                $("#menu_paciente").show();
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
</script>

