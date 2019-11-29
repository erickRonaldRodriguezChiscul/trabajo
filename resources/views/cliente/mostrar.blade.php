<div class="box-body table-responsive no-padding">
    <table id="tablaCliente" class="table table-hover">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Sexo</th>
            <th>Celular</th>
            @if (auth()->user()->tipo == 1)
                <th>Estado</th>
            @endif
            <th colspan="2">Opciones</th>
        </tr>
        
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->apellidos }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->dni }}</td>
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
<div class="box-footer clearfix">
        {{ $clientes->links() }}
</div>
        