<div class="box-body table-responsive no-padding">
    <table id="tablaContacto" class="table table-hover">
        <tr>
            <th>Nombre</th>
            <th>Importe</th>
            <th>Estado</th>
            <th colspan="2">Opciones</th>
        </tr>
        @foreach ($servicios as $servicio)
        <tr>
            <td>{{ $servicio->nombreServicio }}</td>
            <td>{{ $servicio->importe }}</td>
            <td>{{ $servicio->estado }}</td>
            <td>
                <button class="btn btn-success" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $servicio->idServicio }}">
                    <i class="fa fa-pencil"></i> 
                </button>
                <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $servicio->idServicio }}">
                    <i class="fa fa-remove"></i> 
                </button>
            </td>
        </tr>
        @endforeach        
    </table>
</div>
<div class="box-footer clearfix">
        {{ $servicios->links() }}
</div>
        