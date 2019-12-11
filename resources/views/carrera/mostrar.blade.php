@extends('layouts.app')
@section('recorrido')
    <li class="active">
            @if(auth()->user()->tipo == 3)
            Carrera
          @else
            Cliente
          @endif
        </li>
    <li class="active">Mostrar Carrera</li>
@endsection
@section('nombre-pagina-actual','Generar Carrera')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">mostrar carrera</h3>
                <div class="box-tools" id="contenedorBuscar">
                    <div class="input-group" style="width: 240px;">
                        <input type="text" id="buscar" name="table_search" class="form-control" autofocus placeholder="Buscar">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mostrarDatos" style="overflow: auto;">
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> 
                        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tablaCliente" class="table table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Salida</th>
                                            <th>Llegada</th>
                                            <th>Fecha</th>
                                            <th>Emprendedora</th>
                                            <th>Estado</th>
                                            @if (auth()->user()->tipo == 1 || auth()->user()->tipo == 2)
                                                <th>Cliente</th>
                                            @endif
                                            <th colspan="2">Opciones</th>
                                        </tr>
                                    </thead>
                                    @foreach ($carreras as $carrera)
                                    <tr>
                                        <td>{{ $carrera->inicioCarrera }}</td>
                                        <td>{{ $carrera->finalCarrera }}</td>
                                        <td>{{ $carrera->fechaCarrera }}</td>
                                        <td>{{ $carrera->nombreEmprendedora.' '.$carrera->apellidosEmprendedora }}</td>
                                        <td>{{ $carrera->estadoCarrera == 'S'? 'Activo':'Inactivo' }}</td>
                                        @if (auth()->user()->tipo == 1)
                                            <td>{{ $carrera->nombreCliente.' '.$carrera->apellidosCliente }}</td>
                                        @endif
                                        <td>
                                            <button class="btn btn-warning" id="modal-editar" data-target="modal-editar" type="submit" attr-id="{{ $carrera->idCarrera }}">
                                                <i class="fa fa-pencil"></i> 
                                            </button>
                                            <button class="btn btn-danger" type="submit" id="modal-eliminar" data-toggle="modal" data-target="modal-danger" attr-id="{{ $carrera->idCarrera }}">
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
                    {{ $carreras->links() }}
                </div> 
            </div> 
        </div>
    </div>
</div>
@endsection
@section('scriptAgregado')
    <script src="{{ asset('js/popuds.js') }}"></script>
    <script src="{{ asset('js/carrera/carrera.js') }}"></script>
@endsection