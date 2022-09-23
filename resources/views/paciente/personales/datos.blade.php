
<div class="card-body bg-modal">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td>Nombre</td>
                <td id="name">{{$personales->nombre}}</td>
            </tr>
            <tr>
                <td>Fecha Nacimiento</td>
                <td id="date">{{date('d-m-Y',strtotime($personales->nacimiento))}}</td>
            </tr>
            <tr>
                <td>Domicilio</td>
                <td id="adress">{{$personales->domicilio}}</td>
            </tr>
            <tr>
                <td>Comuna</td>
                <td id="commune">{{$personales->commune->name}}</td>
            </tr>
            <tr>
                <td>Region</td>
                <td id="region">{{$personales->commune->region->name}}</td>
            </tr>
            <tr>
                <td>Rut</td>
                <td id="rol">{{$personales->rut}}</td>
            </tr>
            <tr>
                <td>Estado Civil</td>
                <td
                id="status">{{$personales->estado->nombre_estado}}</td>
            </tr>
            <tr>
                <td>Actividad</td>
                <td id="activity">{{$personales->actividad->nombre_actividad}}</td>
            </tr>
            <tr>
                <td>Telefonos</td>
                <td id="phone">{{"+56 ".$personales->telefono}}</td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary w-100" data-toggle="modal" data-target="#editar_personales">Editar Antecedentes Personales</button>
</div>      


