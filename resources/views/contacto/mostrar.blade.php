<div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
        <div class="row">
            <div class="col-sm-12">
                <table id="tablaContacto" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Celular</th>
                            @if (auth()->user()->tipo == 1)
                                <th>Taxista</th>
                                <th>Estado</th>
                            @endif
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    @foreach ($contactos as $contacto)
                    <tr>
                        <td>{{ $contacto->nombreContacto }}</td>
                        <td>{{ $contacto->apellidosContacto }}</td>
                        <td>{{ $contacto->celularContacto }}</td>
                        @if (auth()->user()->tipo == 1)
                        <td>{{ $contacto->nombre }}</td>
                        <td>{{ $contacto->estado == 'S'? 'Activo':'Inactivo' }}</td>
                        @endif
                        <td>
                            <button class="btn btn-warning" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $contacto->id }}">
                                <i class="fa fa-pencil"></i> 
                            </button>
                            <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $contacto->id }}">
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
        {{ $contactos->links() }}
</div>
        