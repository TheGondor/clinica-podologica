<ol class="breadcrumb page-breadcrumb">
	<li class="breadcrumb-item"><a href="/administracion">Panel Administracion</a></li>
	<li class="breadcrumb-item">Antecedentes Morbidos</li>
	<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-exclamation-circle'></i>Antecedentes Morbidos
		<small>

		</small>
	</h1>
</div>
<div class="row">
	<div class="col-xl-12">
        @isset($morbido)
		<div id="panel-6" class="panel">
        @endisset
        @empty($morbido)
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
					<form id="editar_morbido">
                        <input type="hidden" name="metodo" value="Actualizar" id="metodo">
                        @isset($morbido)
                        <input type="hidden" name="metodo" value="{{$morbido->id}}" id="id_morbido">
                        @endisset
                        @empty($morbido)
                        <input type="hidden" name="metodo" value="0" id="id_morbido">
                        @endempty

						<div class="panel-content">
                            <div class="form-row">
                                <div class="col-lg-2 col-sm-6">
                                  <label for="hta">HTA</label>
                                  <select class="custom-select mr-sm-2" name="hta" id="hta2">
                                      @isset($morbido)
                                      @if ($morbido->hta == "SI")
                                      <option value="SI" selected>SI</option>
                                      @else
                                      <option value="SI" >SI</option>
                                      @endif
                                      @if ($morbido->hta == "NO")
                                      <option value="NO" selected>NO</option>
                                      @else
                                      <option value="NO" >NO</option>
                                      @endif
                                      @if ($morbido->hta == "N/S")
                                      <option value="N/S" selected>N/S</option>
                                      @else
                                      <option value="N/S" >N/S</option>
                                      @endif
                                      @if ($morbido->hta == "E/EST")
                                      <option value="E/EST" selected>E/EST</option>
                                      @else
                                      <option value="E/EST" >E/EST</option>
                                      @endif
                                      @endisset
                                      @empty($morbido)
                                      <option value="SI" >SI</option>
                                      <option value="NO" selected >NO</option>
                                      <option value="N/S" >N/S</option>
                                      <option value="E/EST" >E/EST</option>
                                      @endempty
                                  </select>
                                </div>
                                <div class="col-lg-2 col-sm-6">
                                  <label for="dm">DM</label>
                                  <select class="custom-select mr-sm-2" name="dm" id="dm2">
                                      @isset($morbido)
                                      @if ($morbido->dm == "SI")
                                      <option value="SI" selected>SI</option>
                                      @else
                                      <option value="SI" >SI</option>
                                      @endif
                                      @if ($morbido->dm == "NO")
                                      <option value="NO" selected>NO</option>
                                      @else
                                      <option value="NO" >NO</option>
                                      @endif
                                      @if ($morbido->dm == "N/S")
                                      <option value="N/S" selected>N/S</option>
                                      @else
                                      <option value="N/S" >N/S</option>
                                      @endif
                                      @if ($morbido->dm == "E/EST")
                                      <option value="E/EST" selected>E/EST</option>
                                      @else
                                      <option value="E/EST" >E/EST</option>
                                      @endif
                                      @endisset
                                      @empty($morbido)
                                      <option value="SI" >SI</option>
                                      <option value="NO" selected >NO</option>
                                      <option value="N/S" >N/S</option>
                                      <option value="E/EST" >E/EST</option>
                                      @endempty
                                  </select>
                                </div>
                                <div class="col-lg-6 col-sm-8">
                                  <label for="tipo">Tipo</label>
                                  @isset($morbido)
                              <input type="text" class="form-control" name="tipo_dm" value="{{$morbido->tipo}}" id="tipo_dm2">
                              @endisset
                              @empty($morbido)
                              <input type="text" class="form-control" name="tipo_dm" id="tipo_dm2">
                              @endempty
                                </div>
                                <div class="col-lg-2 col-sm-4">
                                  <label for="dm_evolucion">Años Evolucion</label>
                                  @isset($morbido)
                                  <input type="number" class="form-control" name="anos_evolucion" value="{{$morbido->anos_evolucion}}" id="anos_evolucion2">
                                  @endisset
                                  @empty($morbido)
                                  <input type="number" class="form-control" name="anos_evolucion" id="anos_evolucion2">
                                  @endempty
                                </div>
                              </div>
                              <div class="form-row">
                                  <div class="col-lg-6 col-sm-6">
                                  <label for="hta">PCTE Mixto</label>
                                  <select class="custom-select mr-sm-2" name="pcte_mixto" id="pcte_mixto2">
                                      @isset($morbido)
                                      @if ($morbido->pcte_mixto == "SI")
                                      <option value="SI" selected>SI</option>
                                      @else
                                      <option value="SI" >SI</option>
                                      @endif
                                      @if ($morbido->pcte_mixto == "NO")
                                      <option value="NO" selected>NO</option>
                                      @else
                                      <option value="NO" >NO</option>
                                      @endif
                                      @endisset
                                      @empty($morbido)
                                      <option value="SI" >SI</option>
                                      <option value="NO" selected>NO</option>
                                      @endempty
                                  </select>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                  <label for="hta">Control</label>
                                  <select class="custom-select mr-sm-2" name="control" id="control2">
                                      @isset($morbido)
                                      @if ($morbido->control == "SI")
                                      <option value="SI" selected>SI</option>
                                      @else
                                      <option value="SI" >SI</option>
                                      @endif
                                      @if ($morbido->control == "NO")
                                      <option value="NO" selected>NO</option>
                                      @else
                                      <option value="NO" >NO</option>
                                      @endif
                                      @endisset
                                      @empty($morbido)
                                      <option value="SI" >SI</option>
                                      <option value="NO" selected>NO</option>
                                      @endempty
                                  </select>
                                </div>
                              </div>
                                <div class="form-row">
                                  <div class="col-sm-12 col-lg-8">
                                      <label for="alteraciones">Alteraciones Ortopedicas</label>
                                      @isset($morbido)
                                      <input type="text" class="form-control" name="ortopedia" value="{{$morbido->ortopedia}}" id="ortopedia2">
                                      @endisset
                                      @empty($morbido)
                                      <input type="text" class="form-control" name="ortopedia" id="ortopedia2">
                                      @endempty
                                  </div>
                                  <div class="col-sm-12 col-lg-4">
                                      <label for="alteraciones">Fecha</label>
                                      @isset($morbido)
                                      <input type="date" class="form-control" name="fecha_morbido" value="{{date('Y-m-d',strtotime($morbido->fecha))}}" id="fecha_morbido2" required>
                                      @endisset
                                      @empty($morbido)
                                      <input type="date" class="form-control" name="fecha_morbido" value="" id="fecha_morbido2" required>
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
					Antecedentes Morbidos<span class="fw-300"><i>Lista</i></span>
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
						url: "../ver_morbidos",
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
                $("#menu_morbido").addClass('active');
                $("#menu_ficha_morbido").addClass('active');


				$("#editar_morbido").submit(function(e){
					e.preventDefault();
					if($("#metodo").val() == "Guardar")
					{
                        modal = cargando("Guardando Antecedentes Morbido", "Guardando...");
						var check = "true";
					}
					else{
						if($("#metodo").val()=="Actualizar"){
                            modal = cargando("Actualizando Antecedentes Morbido", "Actualizando...");
							var check = "true";
						}
						else{
							var check = "false";
						}
					}
					if(check == "true"){
						var formdata = new FormData(document.getElementById("editar_morbido"));
                        formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
                        formdata.append('id_paciente',$('#id_paciente').val());
                        formdata.append('id_morbido',$('#fecha_morbido').val());
						if($("#metodo").val()=="Actualizar"){
							formdata.append('_method','PUT');
                            formdata.append('id_paciente', $("#id_paciente").val());
                            formdata.append('id_morbido', $("#id_morbido").val());
						}
						else{
							formdata.append('_method','POST');
						}

						$.ajax({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							url: 'morbido',
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
							var rowToScrollTo = document.getElementById('editar_morbido');
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
		$("#hta2").val("NO");
        $("#dm2").val("NO");
        $("#tipo_dm2").val("");
        $("#anos_evolucion2").val("");
        $("#pcte_mixto2").val("NO");
        $("#control2").val("NO");
        $("#ortopedia2").val("");
        $("#fecha_morbido2").val("");
		$("#panel-6").removeClass('d-none');
	}
	function editar(id){
		$("#id_morbido").val(id);
        modal = cargando("Editando Antecedentes Morbido", "Editando...");
		$("#metodo").val('Actualizar');
		$.ajax({
			url: 'morbido/'+id+'/paciente/'+$("#id_paciente").val(),
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
				$("#hta2").val(data.morbido['hta']);
                $("#dm2").val(data.morbido['dm']);
                $("#tipo_dm2").val(data.morbido['tipo']);
                $("#anos_evolucion2").val(data.morbido['anos_evolucion']);
                $("#pcte_mixto2").val(data.morbido['pcte_mixto']);
                $("#control2").val(data.morbido['control']);
                $("#ortopedia2").val(data.morbido['ortopedia']);
                $("#fecha_morbido2").val(data.morbido['fecha']);
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
            modal.out()
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
                modal = cargando("Eliminando Antecedentes Morbido", "Eliminando...");
				var formdata = new FormData();
				formdata.append('_method','DELETE');
                formdata.append('id_morbido',id);
                formdata.append('id_paciente',$("#id_paciente").val());
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: 'morbido',
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
					"Los antecedentes morbidos del paciente no fueron eliminados",
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

</script>

