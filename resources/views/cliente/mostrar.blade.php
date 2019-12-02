<div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
            <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="tablaCliente" class="table table-bordered table-hover dataTable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Numero de Documento</th>
                                <th>Sexo</th>
                                <th>Celular</th>
                                @if (auth()->user()->tipo == 1)
                                    <th>Estado</th>
                                @endif
                                <th colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellidos }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->nmrDocumento }}</td>
                            <td>{{ $cliente->sexo == '0'? 'Masculino':'Femenino' }}</td>
                            <td>{{ $cliente->celularCliente }}</td>
                            @if (auth()->user()->tipo == 1)
                                <td>{{ $cliente->estado == 'S'? 'Activo':'Inactivo' }}</td>
                            @endif
                            <td>
                                <button class="btn btn-warning" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $cliente->id }}">
                                    <i class="fa fa-pencil"></i> 
                                </button>
                                <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $cliente->id }}">
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
        {{ $clientes->links() }}
</div>
        