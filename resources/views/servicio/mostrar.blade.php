<div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
        <div class="row">
            <div class="col-sm-12">
                <table id="tablaContacto" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Importe</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->nombreServicio }}</td>
                        <td>{{ $servicio->importe }}</td>
                        <td>{{ $servicio->estado }}</td>
                        <td>
                            <button class="btn btn-warning" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $servicio->idServicio }}">
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
        </div>
    </div>
</div>
<div class="box-footer clearfix">
        {{ $servicios->links() }}
</div>
        