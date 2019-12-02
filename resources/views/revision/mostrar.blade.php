<div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
        <div class="row">
            <div class="col-sm-12">
                <table id="tablaVehiculo" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Entidad</th>
                            <th>Fecha de vencimiento</th>
                            <th>Observaciones</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    @foreach ($revisiones as $revision)
                    <tr>
                        <td class="entidad">{{ $revision->entidadRevision }}</td>
                        <td class="fecha">{{ $revision->fechaVencimientoRevision }}</td>
                        <td class="observacion">{{ $revision->observacionesRevision }}</td>
                        @if ($revision->idRevision == $revision->revisionActual)
                            <td>
                            <button id="editarRevision" class="btn btn-warning"  type="submit" attr-id="{{ $revision->idRevision }}" attr-src="{{ $revision->fotoRevision }}">
                                <i class="fa fa-pencil"></i> 
                            </button>
                            </td>
                        @else
                            <td>
                            </td>
                        @endif
                    </tr>
                    @endforeach        
                </table>
            </div>
        </div>
    </div>
</div>
<div class="box-footer clearfix">
        {{ $revisiones->links() }}
</div>