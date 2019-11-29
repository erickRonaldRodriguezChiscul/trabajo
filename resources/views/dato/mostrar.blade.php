<div class="box-body table-responsive no-padding">
    <table id="tablaDato" class="table table-hover">
        <tr>
            <th>Descripcion</th>
            <th>Tipo</th>
            @if (auth()->user()->tipo == 1)
                <th>Taxista</th>
                <th>Estado</th>
            @endif
            <th colspan="2">Opciones</th>
        </tr>
        @foreach ($datos as $dato)
        <tr>
            <td>{{ $dato->descripcion }}</td>
            <td>{{ $dato->tipo == '0'? 'Telefono':'Direccion' }}</td>
            @if (auth()->user()->tipo == 1)
            <td>{{ $dato->nombre }}</td>
            <td>{{ $dato->estado == 'S'? 'Activo':'Inactivo' }}</td>
            @endif
            <td>
                <button class="btn btn-warning" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $dato->idDato }}">
                    <i class="fa fa-pencil"></i> 
                </button>
                <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $dato->idDato }}">
                    <i class="fa fa-remove"></i> 
                </button>
            </td>
        </tr>
        @endforeach        
    </table>
</div>
<div class="box-footer clearfix">
        {{ $datos->links() }}
</div>