@extends('layouts.app')
@section('recorrido')
    <li class="active">Dashboard</li>
    <li class="active">Seguimos</li>
@endsection
@section('nombre-pagina-actual','Cliente')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" id="registrarCliente" style="margin-right: 10px;">
                        <i class="fa fa-plus"></i>
                </button>
                <h3 class="box-title">Cliente</h3>
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
            <div id="ingresarDatos">
                
            </div> 
        </div>
    </div>
</div>
@include('popads.eliminar')
@include('popads.editarCliente')
@endsection
@section('scriptAgregado')
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script> 
    <script src="{{ asset('js/popuds.js') }}"></script>
    <script src="{{ asset('js/cliente/cliente.js') }}"></script>
@endsection