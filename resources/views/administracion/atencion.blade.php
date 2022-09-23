

<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
	<li class="breadcrumb-item">Atenciones</li>
	<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-exclamation-circle'></i>Atenciones
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
					<form id="editar_atencion">
                        <input type="hidden" name="metodo" value="Actualizar" id="metodo">
                        <input type="hidden" name="id_atencion" value="0" id="id_atencion">
                        <div class="panel-content">
                            <div class="form-row">
                            <div class="col-sm-12 col-md-4">
                                <label>Fecha</label>
                                <input type="date" class="form-control" id="a_fecha_atencion" name="atencion_fecha" value="{{date('Y-m-d',time())}}" required>
                              </div>
                              <div class="col-sm-12 col-md-4">
                                <label>P/A</label>
                                <input type="text" class="form-control" id="a_pa_atencion" placeholder="Ingresar PA" name="atencion_pa">
                              </div>
                              <div class="col-sm-12 col-md-4">
                                  <label>Pulso Radial</label>
                                  <input type="number" class="form-control" id="a_pulso_radial" placeholder="Ingresar Pulso Radial" name="atencion_pulso_radial">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Peso</label>
                                  <input type="number" class="form-control" id="a_peso" placeholder="Ingresar Peso" name="atencion_peso">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Pulso Pedio (d)</label>
                                  <input type="text" class="form-control" id="a_pulso_pedio_d" placeholder="Ingresar Pulso Pedio" name="atencion_pedio_d">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Pulso Pedio (i)</label>
                                  <input type="text" class="form-control" id="a_pulso_pedio_i" placeholder="Ingresar Pulso Pedio" name="atencion_pedio_i">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Sensibilidad (d)</label>
                                  <input type="text" class="form-control" id="a_sensibilidad_d" placeholder="Ingresar Sensibilidad" name="atencion_sensibilidad_d">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Sensibilidad (i)</label>
                                  <input type="text" class="form-control" id="a_sensibilidad_i" placeholder="Ingresar Sensibilidad" name="atencion_sensibilidad_i">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>T Podal</label>
                                  <input type="number" class="form-control" id="a_t_podal" placeholder="Ingresar T Podal" name="atencion_t_podal">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Atencion Basica</label>
                                  <input type="text" class="form-control" id="a_atencion_basica" placeholder="Ingresar Atencion Basica" name="atencion_podal">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Curacion</label>
                                  <input type="text" class="form-control" id="a_curacion" placeholder="Ingresar Curacion" name="atencion_curacion">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Colocacion Puente</label>
                                  <input type="text" class="form-control" id="a_colocacion_puente" placeholder="Ingresar Colocacion Puente" name="atencion_colocacion">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Resecado</label>
                                  <input type="text" class="form-control" id="a_resecado" placeholder="Ingresar Resecado" name="atencion_resecado">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Enucleacion</label>
                                  <input type="text" class="form-control" id="a_enucleacion" placeholder="Ingresar Enucleasion" name="atencion_enucleasion">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Devastado Ungueal</label>
                                  <input type="text" class="form-control" id="a_devastado_ungueal" placeholder="Ingresar Devastado Ungueal" name="atencion_devastado">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Masoterapia</label>
                                  <input type="text" class="form-control" id="a_masoterapia" placeholder="Ingresar Masoterapia" name="atencion_masoterapia">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Espiculoectomia</label>
                                  <input type="text" class="form-control" id="a_espiculoectomia" placeholder="Ingresar Espiculoectomia" name="atencion_espiculoectomia">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Analgesia</label>
                                  <input type="text" class="form-control" id="a_analgesia" placeholder="Ingresar Analgesia" name="atencion_analgesia">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Colocacion Acrilico</label>
                                  <input type="text" class="form-control" id="a_colocacion_acrilico" placeholder="Ingresar Colocacion Acrilico" name="atencion_acrilico">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Colocacion Banda</label>
                                  <input type="text" class="form-control" id="a_colocacion_banda" placeholder="Ingresar Colocacion Banda" name="atencion_banda">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>C. Bracket</label>
                                  <input type="text" class="form-control" id="a_cbracket" placeholder="Ingresar C Bracket" name="atencion_bracket">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>C. Policarboxilato</label>
                                  <input type="text" class="form-control" id="a_cpolicarboxilato" placeholder="Ingresar C Policarboxilato" name="atencion_policarboxilato">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                  <label>Observacion</label>
                                  <input type="text" class="form-control" id="a_observacion" placeholder="Ingresar Observacion" name="atencion_descripcion">
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
					Atenciones<span class="fw-300"><i>Lista</i></span>
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
                            <th>Fecha Atencion</th>
							<th>Accion</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<th>Fecha Atencion</th>
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
						url: "../ver_atenciones",
                        type: 'POST',
                        data: {id_paciente: $("#id_paciente").val()}
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
					],
					drawCallback: function(settings) {
						var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
						pagination.toggle(this.api().page.info().pages > 1);
					}
				});

                $(".active").removeClass('active');
				$("#menu_atencion").addClass('active');
                $("#menu_paciente").addClass('active open');

				$("#editar_atencion").submit(function(e){
					e.preventDefault();
					if($("#metodo").val() == "Guardar")
					{
                        modal = cargando("Guardando atención", "Guardando...");
						var check = "true";
					}
					else{
						if($("#metodo").val()=="Actualizar"){
                            modal = cargando("Actualizar atención", "Actualizando...");
							var check = "true";
						}
						else{
							var check = "false";
						}
					}
					if(check == "true"){
						var formdata = new FormData(document.getElementById("editar_atencion"));
                        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                        formdata.append('id_paciente',$('#id_paciente').val());
                        formdata.append('id_atencion',$('#fecha_atencion').val());
						if($("#metodo").val()=="Actualizar"){
							formdata.append('_method','PUT');
                            formdata.append('id_paciente', $("#id_paciente").val());
                            formdata.append('id_atencion', $("#id_atencion").val());
						}
						else{
							formdata.append('_method','POST');
						}

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							url: 'atencion',
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
							var rowToScrollTo = document.getElementById('editar_atencion');
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
		$("#a_fecha_atencion").val("");
        $("#a_pa_atencion").val("");
        $("#a_pulso_radial").val("");
        $("#a_peso").val("");
        $("#a_pulso_pedio_d").val("");
        $("#a_pulso_pedio_i").val("");
        $("#a_sensibilidad_d").val("");
        $("#a_sensibilidad_i").val("");
        $("#a_t_podal").val("");
        $("#a_atencion_basica").val("");
        $("#a_curacion").val("");
        $("#a_colocacion_puente").val("");
        $("#a_resecado").val("");
        $("#a_enucleacion").val("");
        $("#a_devastado_ungueal").val("");
        $("#a_masoterapia").val("");
        $("#a_espiculoectomia").val("");
        $("#a_analgesia").val("");
        $("#a_colocacion_acrilico").val("");
        $("#a_colocacion_banda").val("");
        $("#a_cbracket").val("");
        $("#a_cpolicarboxilato").val("");
        $("#a_observacion").val("");
		$("#panel-6").removeClass('d-none');
	}
	function editar(id){
		$("#id_atencion").val(id);
        modal = cargando("Cargando atención", "Cargando...");
		$("#metodo").val('Actualizar');
		$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url: 'atencion/'+id+'/paciente/'+$("#id_paciente").val(),
            type: 'GET',
			processData: true,
			contentType: false,
			success: function(data){
			//console.log(respuesta.resultado);
			//console.log(respuesta.mensaje);
			if(data.estado=="true"){
				$("#tituloAccion").html('Editar');
				$("#btnAccion").html('Actualizar');
				$("#a_fecha_atencion").val(data.atencion.atencion_fecha);
                $("#a_pa_atencion").val(data.atencion.atencion_pa);
                $("#a_pulso_radial").val(data.atencion.atencion_pulso_radial);
                $("#a_peso").val(data.atencion.atencion_peso);
                $("#a_pulso_pedio_d").val(data.atencion.atencion_pedio_d);
                $("#a_pulso_pedio_i").val(data.atencion.atencion_pedio_i);
                $("#a_sensibilidad_d").val(data.atencion.atencion_sensibilidad_d);
                $("#a_sensibilidad_i").val(data.atencion.atencion_sensibilidad_i);
                $("#a_t_podal").val(data.atencion.atencion_t_podal);
                $("#a_atencion_basica").val(data.atencion.atencion_podal);
                $("#a_curacion").val(data.atencion.atencion_curacion);
                $("#a_colocacion_puente").val(data.atencion.atencion_colocacion);
                $("#a_resecado").val(data.atencion.atencion_resecado);
                $("#a_enucleacion").val(data.atencion.atencion_enucleasion);
                $("#a_devastado_ungueal").val(data.atencion.atencion_devastado);
                $("#a_masoterapia").val(data.atencion.atencion_masoterapia);
                $("#a_espiculoectomia").val(data.atencion.atencion_espiculoectomia);
                $("#a_analgesia").val(data.atencion.atencion_analgesia);
                $("#a_colocacion_acrilico").val(data.atencion.atencion_acrilico);
                $("#a_colocacion_banda").val(data.atencion.atencion_banda);
                $("#a_cbracket").val(data.atencion.atencion_bracket);
                $("#a_cpolicarboxilato").val(data.atencion.atencion_policarboxilato);
                $("#a_observacion").val(data.atencion.atencion_descripcion);
				$("#panel-6").removeClass('d-none');

				var selectedPanel = $("#panel-6").closest('.panel');
				selectedPanel.children('.panel-container').collapse('show')
				.on('show.bs.collapse', function() {
					selectedPanel.removeClass("panel-collapsed");
				});
                document.documentElement.scrollTop = 0;
                modal.out();
			}
			else{
                modal.out()
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: data.mensaje,
				})
			}
		},
		error: function(){
            modal.out
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
                modal = cargando("Eliminando atención", "Eliminando...");
				var formdata = new FormData();
				formdata.append('_method','DELETE');
                formdata.append('id_atencion',id);
                formdata.append('id_paciente',$("#id_paciente").val());
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: 'atencion',
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
                modal.out()
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: data.mensaje,
				})
			}
		},
		error: function(){
            modal.out()
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
					"La atención no fue eliminada",
					"error"
					);
			}
		});
	}

</script>

