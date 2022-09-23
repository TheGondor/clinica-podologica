@extends('layouts.app')

@section('content')
<div class="container border rounded bg-modal shadow-lg p-5">
   <div class="table-responsive">
        <table class="table table-sm w-100 table-striped" id="tabla_pacientes">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Accion</th>
                </tr>
            </thead>
        </table>
   </div>
   <button class="btn btn-success" data-toggle="modal" data-target="#modal_crear_paciente">Nuevo Paciente</button>
</div>
<script type="application/javascript">


 //ELIMINAR PACIENTES

 function eliminar_paciente(id){
    idleTime = 0;
    alertify.confirm('Eliminar Paciente', '¿Esta seguro/a de que quiere eliminar este paciente?', function(){
        var modal = cargando("Eliminar Paciente", "Eliminando...");
        $.ajax({
            url: 'eliminar_paciente',
            type: 'POST',
            data : {
                    _token :  $('meta[name="csrf-token"]').attr('content'),
                    id : id
                },
            success: function(data){
                //console.log(respuesta.resultado);
                //console.log(respuesta.mensaje);
                if(data.estado=="true"){
                    alertify.success(data.mensaje);
                    $('#tabla_pacientes').DataTable().ajax.reload();
                }
                else{
                    alertify.error(data.mensaje);
                }
                modal.out();
            },
            error: function(){
                alertify.error("Ocurrio un error al intentar eliminar el paciente");
                modal.out();
            }
        })
            
        }
            , function(){ alertify.error('No se elimino el paciente')});
    }

    function ver_paciente(id){
        window.location.href = "/paciente/"+id;
    }

    //LLENAR SELECT COMUNAS
    function llenarcomunas(id_comuna){
        idleTime = 0;
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
                $("#id_commune").append('<option selected value="">Seleccione Comuna</option>');
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
    $(document).ready(function(){
    
    $('#tabla_pacientes').DataTable({
     processing: true,
     serverSide: true,
     responsive: true,
     type: 'POST',
     ajax:{
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url: "ver_pacientes",
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
        className: 'text-center'
       }
     ]
    });
    })
    </script> 

@include('paciente.modal_crear_paciente',compact('regiones'))
@endsection