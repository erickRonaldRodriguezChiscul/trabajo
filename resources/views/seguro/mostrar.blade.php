<div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
            <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="tablaSeguro" class="table table-bordered table-hover dataTable">
                        <thead>
                            <tr>
                                <th>Entidad</th>
                                <th>Fecha de vencimiento</th>
                                <th>Opcion</th>
                            </tr>
                        </thead>
                        @foreach ($seguros as $seguro)
                        <tr>
                            <td class="entidad">{{ $seguro->entidadSeguro }}</td>
                            <td class="fecha">{{ $seguro->fechaVencimientoSeguro }}</td>
                            @if ($seguro->idSeguro == $seguro->seguroActual)
                                <td>
                                <button id="editarSeguro" class="btn btn-warning"  type="submit" attr-id="{{ $seguro->idSeguro }}" attr-src="{{ $seguro->fotoSeguro }}">
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
        {{ $seguros->links() }}
    </div>