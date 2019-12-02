@extends('layouts.app')
@section('recorrido')
    <li class="active">Vehiculo</li>
    <li class="active">SOAT</li>
@endsection
@section('nombre-pagina-actual','soat')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">soat</h3>
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
            <div id="ingresarDatos"  style="overflow: auto;">
                
            </div> 
        </div>
    </div>
</div>
@include('popads.mostrarSoat')
@endsection
@section('scriptAgregado')
    <script src="{{ asset('js/popuds.js') }}"></script>
    <script src="{{ asset('js/soat/soat.js') }}"></script>
@endsection