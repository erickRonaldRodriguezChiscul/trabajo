<div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
        <div class="row">
            <div class="col-sm-12">
                <table id="tablaTaxis" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>numero de documento</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($personas as $persona)
                    <tr>
                        <td>{{ $persona->nombre }}</td>
                        <td>{{ $persona->apellidos }}</td>
                        <td>{{ $persona->email }}</td>
                        <td>{{ $persona->nmrDocumento }}</td>
                        <td>{{ $persona->estado == 'S'? 'Activo':'Inactivo' }}</td>
                        <td>
                            <button class="btn btn-warning" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $persona->id }}">
                                <i class="fa fa-pencil"></i> 
                            </button>
                            <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $persona->id }}">
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
        {{ $personas->links() }}
</div>