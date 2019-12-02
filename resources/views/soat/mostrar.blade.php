<div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
        <div class="row">
            <div class="col-sm-12">
                <table id="tablaSoat" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>Entidad</th>
                            <th>Fecha de vencimiento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    @foreach ($soats as $soat)
                    <tr>
                        <td class="entidad">{{ $soat->entidadSoat }}</td>
                        <td class="fecha">{{ $soat->fechaVencimientoSoat }}</td>
                        @if ($soat->idSoat == $soat->soatActual)
                            <td>
                            <button id="editarSoat" class="btn btn-warning"  type="submit" attr-id="{{ $soat->idSoat }}" attr-src="{{ $soat->fotoSoat }}">
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
    {{ $soats->links() }}
</div>