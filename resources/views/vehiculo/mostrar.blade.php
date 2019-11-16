<div class="box-body table-responsive no-padding">
    <table id="tablaVehiculo" class="table table-hover">
        <tr>
            <th>Marca</th>
            <th>Placa</th>
            <th>Tipo</th>
            <th>Año de Fabricacion</th>
            <th>SOAT</th>
            <th>Revision Tecnica</th>
            @if (auth()->user()->tipo == 1)
                <th>Taxista</th>
                <th>Estado</th>
            @endif
            <th colspan="2">Opciones</th>
        </tr>
        @foreach ($vehiculos as $vehiculo)
        <tr>
            <td>{{ $vehiculo->marcaVehiculo }}</td>
            <td>{{ $vehiculo->placaVehiculo }}</td>
            <td>{{ $vehiculo->tipoVehiculo == '0'? 'Automovil':'Motocicleta'}}</td>
            <td>{{ $vehiculo->yearFabricacion }}</td>
            <td>{{ $vehiculo->soat }}</td>
            <td>{{ $vehiculo->revisionTecnica }}</td>
            @if (auth()->user()->tipo == 1)
                <td>{{ $vehiculo->nombre }}</td>
                <td>{{ $vehiculo->estado == 'S'? 'Activo':'Inactivo' }}</td>
            @endif
            <td>
                <button class="btn btn-success" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $vehiculo->idVehiculo }}">
                    <i class="fa fa-pencil"></i> 
                </button>
                <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $vehiculo->idVehiculo }}">
                    <i class="fa fa-remove"></i> 
                </button>
            </td>
        </tr>
        @endforeach        
    </table>
</div>
<div class="box-footer clearfix">
        {{ $vehiculos->links() }}
</div>
        