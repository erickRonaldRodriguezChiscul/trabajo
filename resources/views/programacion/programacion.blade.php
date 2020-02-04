@extends('layouts.app')
@section('recorrido')
    <li class="active">Dashboard</li>
    <li class="active">Seguimos</li>
@endsection
@section('styleAgregado')
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
@endsection
@section('nombre-pagina-actual','Programación')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Programación</h3>
            </div>
            <div id="ingresarDatos">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="mensaje-error">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="daterange">Rango de Fecha</label>
                                <input id="daterange" class="form-control" type="text" name="daterange" value="{{ date('dmY') }} - {{ date('dmY') }}" />
                                <div class="daterange">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div id="buscador"></div>
                        </div>
                        <div class="col-md-4">
                            <div id="buscadorServicio"></div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" id="aceptar" class="btn btn-primary">
                        Registrar
                    </button>
                    <button id="limpiar" type="button" class="btn btn-success">
                        Limpiar
                    </button>
                </div>
            </div>     
        </div>
    </div>
</div>
<div class="row" id="mostrar">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" id="contenedorBuscar">
                    <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                        <input type="text" id="buscar" name="table_search" class="form-control pull-right" autofocus placeholder="Buscar">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mostrarDatos">
            </div>     
        </div>
    </div>
</div>
@include('popads.eliminar')
@include('popads.editarProgramacion')
@endsection
@section('scriptAgregado')
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script> 
    <script src="{{ asset('js/programacion/moment.min.js') }}"></script>
    <script src="{{ asset('js/programacion/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/programacion/programacion.js') }}"></script>
    <script src="{{ asset('js/popuds.js') }}"></script>
@endsection