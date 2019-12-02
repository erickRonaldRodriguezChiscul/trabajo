<div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
        <div class="row">
            <div class="col-sm-12">
                <table id="tablaVehiculo" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Placa</th>
                            <th>Tipo</th>
                            <th>Año de Fabricacion</th>
                            <th>Modelo</th>
                            @if (auth()->user()->tipo == 1)
                                <th>Emprendedora</th>
                                <th>Estado</th>
                            @endif
                            <th colspan="2">Historial</th>
                        </tr>
                    </thead>
                    @foreach ($vehiculos as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->marcaVehiculo }}</td>
                        <td>{{ $vehiculo->placaVehiculo }}</td>
                        <td>{{ $vehiculo->tipoVehiculo == '0'? 'Automovil':'Motocicleta'}}</td>
                        <td>{{ $vehiculo->yearFabricacion }}</td>
                        <td>{{ $vehiculo->modeloVehiculo }}</td>
                        @if (auth()->user()->tipo == 1)
                            <td>{{ $vehiculo->nombre }}</td>
                            <td>{{ $vehiculo->estado == 'S'? 'Activo':'Inactivo' }}</td>
                        @endif
                        <td>
                            <button class="btn btn-warning" id="modal-historial" data-target="modal-historial" type="submit" attr-id="{{ $vehiculo->idVehiculo }}">
                                <i class="fa fa-book"></i> 
                            </button>
                        </td>
                    </tr>
                    @endforeach        
                </table>
            </div>
        </div>
    </div>
</div>
<div class="box-footer clearfix">
        {{ $vehiculos->links() }}
</div>