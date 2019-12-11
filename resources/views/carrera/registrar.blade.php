@extends('layouts.app')
@section('recorrido')
    <li class="active">
            @if(auth()->user()->tipo == 3)
            Carrera
          @else
            Cliente
          @endif
        </li>
    <li class="active">Generar Carrera</li>
@endsection
@section('nombre-pagina-actual','Generar Carrera')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Generar Carrera</h3>
            </div>
            <div id="ingresarDatos" style="overflow: auto;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="mensaje-error">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccionInicio">Dirección Inicio</label>
                                <input id="direccionInicio" class="form-control" type="text" name="direccionInicio"/>
                                <div class="direccionInicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccionLlegada">Dirección de Llegada</label>
                                <input id="direccionLlegada" class="form-control" type="text" name="direccionLlegada"/>
                                <div class="direccionLlegada">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div id="buscadorPersona"></div>
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
@endsection
@section('scriptAgregado')
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script> 
    <script src="{{ asset('js/popuds.js') }}"></script>
    <script src="{{ asset('js/carrera/carrera.js') }}"></script>
@endsection