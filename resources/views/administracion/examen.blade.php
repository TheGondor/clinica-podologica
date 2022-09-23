<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
	<li class="breadcrumb-item">Examen General</li>
	<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-exclamation-circle'></i>Examen General
		<small>

		</small>
	</h1>
</div>
<div class="row">
	<div class="col-xl-12">
        @isset($examen)
		<div id="panel-6" class="panel">
        @endisset
        @empty($examen)
        <div id="panel-6" class="panel d-none">
        @endempty
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
					<form id="editar_examen">
                        <input type="hidden" name="metodo" value="Actualizar" id="metodo">
                        @isset($examen)
                        <input type="hidden" name="metodo" value="{{$examen->id}}" id="id_examen">
                        @endisset
                        @empty($examen)
                        <input type="hidden" name="metodo" value="0" id="id_examen">
                        @endempty

						<div class="panel-content">
                            @isset($examen)
                            <fieldset>
                                <div class="form-row form-group">
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Pulso(radial)</label>
                                        <input type="text" class="form-control" id="pulso_radial" name="pulso_radial" value="{{$examen->pulso_radial}}">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">P/A</label>
                                        <input type="text" class="form-control" id="pa" name="pa" value="{{$examen->pa}}">
                                    </div>
                                    <div class="col-lg-3 col-sm 6">
                                        <label for="dm_tipo">Pulso (pedio) [d]</label>
                                        <input type="text" class="form-control" id="pulso_pedio_d" name="pulso_pedio_d" value="{{$examen->pulso_pedio_d}}">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Puslo (pedio)[i]</label>
                                        <input type="text" class="form-control" id="pulso_pedio_i" name="pulso_pedio_i" value="{{$examen->pulso_pedio_i}}">
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Peso (KG)</label>
                                        <input type="number" class="form-control" id="peso" name="peso" value="{{$examen->peso}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Talla (cms)</label>
                                        <input type="number" class="form-control" id="talla" name="talla" value="{{$examen->talla}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">IMC</label>
                                        <input type="number" class="form-control" id="imc" name="imc" value="{{$examen->imc}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Amputacion</label>
                                        <select class="custom-select mr-sm-2" id="amputacion" name="amputacion" value="{{$examen->amputacion}}">
                                            @if ($examen->amputacion == "SI")
                                            <option value="SI" selected>SI</option>
                                            @else
                                            <option value="SI">SI</option>
                                            @endif

                                            @if ($examen->amputacion == "NO")
                                            <option value="NO" selected>NO</option>
                                            @else
                                            <option value="NO">NO</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Ubicacion</label>
                                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{$examen->ubicacion}}">
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">N Calzado</label>
                                        <input type="number" class="form-control" id="calzado" name="calzado" value="{{$examen->calzado}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Sensibilidad (d)</label>
                                        <input type="text" class="form-control" id="sensibilidad_d" name="sensibilidad_d" value="{{$examen->sensibilidad_d}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Sensibilidad (i)</label>
                                        <input type="text" class="form-control" id="sensibilidad_i" name="sensibilidad_i" value="{{$examen->sensibilidad_i}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">T Podal (d)</label>
                                        <input type="text" class="form-control" id="t_podal_d" name="t_podal_d" value="{{$examen->t_podal_d}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">T Podal (i)</label>
                                        <input type="text" class="form-control" id="t_podal_i" name="t_podal_i" value="{{$examen->t_podal_i}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Varices Extr. Infeior</label>
                                        <select class="custom-select  mr-sm-2" id="varices" name="varices">
                                            @if ($examen->varices == "SI")
                                            <option value="SI" selected>SI</option>
                                            @else
                                            <option value="SI">SI</option>
                                            @endif

                                            @if ($examen->varices == "NO")
                                            <option value="NO" selected>NO</option>
                                            @else
                                            <option value="NO">NO</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Heridas</label>
                                        <select class="custom-select  mr-sm-2" id="herida" name="herida">
                                            @if ($examen->herida == "SI")
                                            <option value="SI" selected>SI</option>
                                            @else
                                            <option value="SI">SI</option>
                                            @endif

                                            @if ($examen->herida == "NO")
                                            <option value="NO" selected>NO</option>
                                            @else
                                            <option value="NO">NO</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Ubicacion</label>
                                        <input type="text" class="form-control" id="heridas" name="heridas" value="{{$examen->heridas}}">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Tipo</label>
                                        <input type="text" class="form-control" id="tipo" name="tipo" value="{{$examen->tipo}}">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Tratamiento</label>
                                        <input type="text" class="form-control" id="tratamiento" name="tratamiento" value="{{$examen->tratamiento}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Nevos</label>
                                        <select class="custom-select mr-sm-2" id="nevo" name="nevo">
                                            @if ($examen->nevo == "SI")
                                            <option value="SI" selected>SI</option>
                                            @else
                                            <option value="SI">SI</option>
                                            @endif

                                            @if ($examen->nevo == "NO")
                                            <option value="NO" selected>NO</option>
                                            @else
                                            <option value="NO">NO</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Ubicacion</label>
                                        <input type="text" class="form-control" id="nevos" name="nevos" value="{{$examen->nevos}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Maculas</label>
                                        <select class="custom-select mr-sm-2" id="macula" name="macula">
                                            @if ($examen->macula == "SI")
                                            <option value="SI" selected>SI</option>
                                            @else
                                            <option value="SI">SI</option>
                                            @endif

                                            @if ($examen->macula == "NO")
                                            <option value="NO" selected>NO</option>
                                            @else
                                            <option value="NO">NO</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Tipo</label>
                                        <input type="text" class="form-control" id="maculas" name="maculas" value="{{$examen->maculas}}">
                                    </div>
                                </div>
                            </fieldset>
                        @endisset
                        @empty($examen)
                            <fieldset>
                                <div class="form-row form-group">
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Pulso(radial)</label>
                                        <input type="text" class="form-control" id="pulso_radial" name="pulso_radial">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">P/A</label>
                                        <input type="text" class="form-control" id="pa" name="pa">
                                    </div>
                                    <div class="col-lg-3 col-sm 6">
                                        <label for="dm_tipo">Pulso (pedio) [d]</label>
                                        <input type="text" class="form-control" id="pulso_pedio_d" name="pulso_pedio_d">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Puslo (pedio)[i]</label>
                                        <input type="text" class="form-control" id="pulso_pedio_i" name="pulso_pedio_i">
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Peso (KG)</label>
                                        <input type="number" class="form-control" id="peso" name="peso">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Talla (cms)</label>
                                        <input type="number" class="form-control" id="talla" name="talla">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">IMC</label>
                                        <input type="number" class="form-control" id="imc" name="imc">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Amputacion</label>
                                        <select class="custom-select mr-sm-2" id="amputacion" name="amputacion">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Ubicacion</label>
                                        <input type="text" class="form-control" id="ubicacion" name="amputacion">
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">N Calzado</label>
                                        <input type="number" class="form-control" id="calzado" name="calzado">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Sensibilidad (d)</label>
                                        <input type="text" class="form-control" id="sensibilidad_d" name="sensibilidad_d">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Sensibilidad (i)</label>
                                        <input type="text" class="form-control" id="sensibilidad_i" name="sensibilidad_i">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">T Podal (d)</label>
                                        <input type="text" class="form-control" id="t_podal_d" name="t_podal_d">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">T Podal (i)</label>
                                        <input type="text" class="form-control" id="t_podal_i" name="t_podal_i">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Varices Extr. Infeior</label>
                                        <select class="custom-select  mr-sm-2" id="varices" name="varices">
                                            <option value="SI" >SI</option>
                                            <option value="NO" >NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Heridas</label>
                                        <select class="custom-select  mr-sm-2" id="herida" name="herida">
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Ubicacion</label>
                                        <input type="text" class="form-control" id="heridas" name="heridas">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Tipo</label>
                                        <input type="text" class="form-control" id="tipo" name="tipo">
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <label for="dm_evolucion">Tratamiento</label>
                                        <input type="text" class="form-control" id="tratamiento" name="tratamiento">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Nevos</label>
                                        <select class="custom-select mr-sm-2" id="nevo" name="nevo" >
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Ubicacion</label>
                                        <input type="text" class="form-control" id="nevos" name="nevos">
                                    </div>
                                    <div class="col-lg-2 col-sm-4">
                                        <label for="dm_evolucion">Maculas</label>
                                        <select class="custom-select mr-sm-2" id="macula">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-sm-8">
                                        <label for="dm_evolucion">Tipo</label>
                                        <input type="text" class="form-control" id="maculas" name="maculas">
                                    </div>
                                </div>
                            </fieldset>
                        @endempty
                            <div class="form-row form-group">
                                <div class="col-sm-12 col-lg-4">
                                    <label for="alteraciones">Fecha</label>
                                    @isset($examen)
                                    <input type="date" class="form-control" name="fecha" value="{{date('Y-m-d',strtotime($examen->fecha))}}" id="fecha" required>
                                    @endisset
                                    @empty($examen)
                                    <input type="date" class="form-control" name="fecha" value="" id="fecha" required>
                                    @endempty
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
					Examen General<span class="fw-300"><i>Lista</i></span>
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
							<th>Fecha</th>
							<th>Accion</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr>
							<th>Fecha</th>
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
						url: "../ver_examenes",
                        type: 'POST',
                        data: {id_paciente: $("#id_paciente").val()}
					},
					columns:[
						{
						data: 'fecha',
						name: 'fecha'

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
                $("#menu_examen").addClass('active');
                $("#menu_ficha_examen").addClass('active');


				$("#editar_examen").submit(function(e){
					e.preventDefault();
					if($("#metodo").val() == "Guardar")
					{
                        var check = "true";
                        modal = cargando("Guardando Examen", "Guardando...");
					}
					else{
						if($("#metodo").val()=="Actualizar"){
                            var check = "true";
                            modal = cargando("Editando Examen", "Editando...");
						}
						else{
							var check = "false";
						}
					}
					if(check == "true"){
						var formdata = new FormData(document.getElementById("editar_examen"));
                        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                        formdata.append('id_paciente',$('#id_paciente').val());
                        formdata.append('id_examen',$('#fecha_examen').val());
						if($("#metodo").val()=="Actualizar"){
							formdata.append('_method','PUT');
                            formdata.append('id_paciente', $("#id_paciente").val());
                            formdata.append('id_examen', $("#id_examen").val());
						}
						else{
							formdata.append('_method','POST');
						}

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							url: 'examen',
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
							var rowToScrollTo = document.getElementById('editar_examen');
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
		$("#pulso_radial").val("");
        $("#pa").val("");
        $("#pulso_pedio_d").val("");
        $("#pulso_pedio_i").val("");
        $("#peso").val("");
        $("#talla").val("");
        $("#imc").val("");
        $("#ubicacion").val("");
        $("#amputacion").val("NO");
        $("#calzado").val("");
        $("#sensibilidad_d").val("");
        $("#sensibilidad_i").val("");
        $("#t_podal_d").val("");
        $("#t_podal_i").val("");
        $("#varices").val("NO");
        $("#heridas").val("");
        $("#herida").val("NO");
        $("#tipo").val("");
        $("#tratamiento").val("");
        $("#nevos").val("");
        $("#nevo").val("NO")
        $("#maculas").val("");
        $("#macula").val("NO");
        $("#fecha").val("");
		$("#panel-6").removeClass('d-none');
	}
	function editar(id){
		$("#id_examen").val(id);
        modal = cargando("Cargando Examen", "Cargando...");
		$("#metodo").val('Actualizar');
		$.ajax({
			url: 'examen/'+id+'/paciente/'+$("#id_paciente").val(),
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
				$("#pulso_radial").val(data.examen.pulso_radial);
                $("#pa").val(data.examen.pa);
                $("#pulso_pedio_d").val(data.examen.pulso_pedio_d);
                $("#pulso_pedio_i").val(data.examen.pulso_pedio_i);
                $("#peso").val(data.examen.peso);
                $("#talla").val(data.examen.talla);
                $("#imc").val(data.examen.imc);
                $("#ubicacion").val(data.examen.ubicacion);
                $("#amputacion").val(data.examen.amputacion)
                $("#calzado").val(data.examen.calzado);
                $("#sensibilidad_d").val(data.examen.sensibilidad_d);
                $("#sensibilidad_i").val(data.examen.sensibilidad_i);
                $("#t_podal_d").val(data.examen.t_podal_d);
                $("#t_podal_i").val(data.examen.t_podal_i);
                $("#varices").val(data.examen.varices);
                $("#heridas").val(data.examen.heridas);
                $("#herida").val(data.examen.herida);
                $("#tipo").val(data.examen.tipo);
                $("#tratamiento").val(data.examen.tratamiento);
                $("#nevos").val(data.examen.nevos);
                $("#nevo").val(data.examen.nevo)
                $("#maculas").val(data.examen.maculas);
                $("#macula").val(data.examen.macula);
                $("#fecha").val(data.examen['fecha']);
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
                modal = cargando("Eliminando Examen", "Eliminando...");
				var formdata = new FormData();
				formdata.append('_method','DELETE');
                formdata.append('id_examen',id);
                formdata.append('id_paciente',$("#id_paciente").val());
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: 'examen',
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
					"El examen físico general no fue eliminado",
					"error"
					);
			}
		});
	}

</script>

