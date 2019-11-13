<div class="box-body table-responsive no-padding">
    <table id="tablaTaxis" class="table table-hover">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Estado</th>
            <th colspan="2">Opciones</th>
        </tr>
        
        @foreach ($personas as $persona)
        @if ($persona->id<>auth()->user()->id) 
        <tr>
            <td>{{ $persona->nombre }}</td>
            <td>{{ $persona->apellidos }}</td>
            <td>{{ $persona->email }}</td>
            <td>{{ $persona->dni }}</td>
            <td>{{ $persona->estado == 'S'? 'Activo':'Inactivo' }}</td>
            <td>
                <button class="btn btn-success" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $persona->id }}">
                    <i class="fa fa-pencil"></i> 
                </button>
                <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $persona->id }}">
                    <i class="fa fa-remove"></i> 
                </button>
            </td>
        </tr>
        @endif
        @endforeach        
    </table>
</div>
<div class="box-footer clearfix">
        {{ $personas->links() }}
</div>
        