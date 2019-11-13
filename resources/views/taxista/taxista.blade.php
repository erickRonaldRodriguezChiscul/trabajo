@extends('layouts.app')
@section('recorrido')
    <li class="active">Dashboard</li>
    <li class="active">Seguimos</li>
@endsection
@section('nombre-pagina-actual','Taxistas')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" id="registrarTaxista" style="margin-right: 10px;">
                        <i class="fa fa-plus"></i>
                </button>
                <h3 class="box-title">Taxistas</h3>
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
            <div id="ingresarDatos">
                
            </div> 
        </div>
    </div>
</div>
@include('popads.eliminar')
@include('popads.editarTaxista')
@endsection
@section('scriptAgregado')
    <script src="{{ asset('js/popuds.js') }}"></script>
    <script src="{{ asset('js/taxista/taxista.js') }}"></script>
@endsection