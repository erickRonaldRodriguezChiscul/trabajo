<div class="box-body table-responsive no-padding">
    <table id="tablaTaxis" class="table table-hover">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Numero de documento</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        @foreach ($personas as $persona)
        <tr>
            <td>{{ $persona->nombre }}</td>
            <td>{{ $persona->apellidos }}</td>
            <td>{{ $persona->email }}</td>
            <td>{{ $persona->nmrDocumento }}</td>
            <td>{{ $persona->estado == 'S'? 'Activo':'Inactivo' }}</td>
            <td>
                <input type="radio" value="{{ $persona->idPersona }}" name="persona"/>
            </td>
        </tr>
        @endforeach        
    </table>
</div>
<div class="box-footer clearfix">
        {{ $personas->links() }}
</div>
        