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
                            <th>Numero de documento</th>
                            <th>Estado</th>
                            <th>Opciones</th>
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
                            <input type="radio" value="{{ $persona->idPersona }}" name="persona"/>
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
        