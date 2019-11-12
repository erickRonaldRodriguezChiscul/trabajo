
<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>DNI</th>
            <th colspan="2">Opciones</th>
        </tr>
        
            @foreach ($personas as $persona)
        <tr>
            <td>{{ $persona->nombre }}</td>
            <td>{{ $persona->apellidos }}</td>
            <td>{{ $persona->email }}</td>
            <td>{{ $persona->dni }}</td>
            <td>
                <button class="btn btn-success" type="submit" attr-id="{{ $persona->id }}">
                    <i class="fa fa-pencil"></i> 
                </button>
                <button class="btn btn-danger" type="submit" attr-id="{{ $persona->id }}">
                    <i class="fa fa-remove"></i> 
                </button>
            </td>
        </tr>
        @endforeach        
    </table>
</div>
<div class="box-footer clearfix">
        {{ $personas->links() }}
</div>
        