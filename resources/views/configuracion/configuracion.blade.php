@extends('layouts.app')
@section('recorrido')
    <li class="active">Dashboard</li>
    <li class="active">Seguimos</li>
@endsection
@section('nombre-pagina-actual','Configuracion')
@section('content')
<div class="row" id="contenedor">
    <div class="col-xs-6">
        <div class="box">
            <div class="mensaje-error">
            </div>
            <form role="form" id="addConfiguracion" action="#">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="passwordActual">Contraseña Actual</label>
                        <input type="text" class="form-control" id="passwordActual" name="passwordActual" placeholder="Contraseña Actual">
                    </div>
                    <label for="nuevoPassword">Nueva Contraseña</label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="nuevoPassword" name="nuevoPassword" placeholder="Nueva Contraseña">
                            <span id="iconNuevo"  class="input-group-addon" style="cursor: pointer;"><i class="fa fa-unlock-alt"></i></span>
                        </div>
                        <div class="nuevoPassword">
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="verificarPassword">Verificar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="verificarPassword" name="verificarPassword"verificarPassword placeholder="Verificar Contraseña">
                            <span id="iconVerificar" class="input-group-addon" style="cursor: pointer;"><i class="fa fa-unlock-alt"></i></span>
                        </div>
                        <div class="verificarPassword">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                  <button id="registrarConfig" class="btn btn-primary">Registrar</button>
                </div>
              </form>
        </div>
    </div>
</div>
@endsection
@section('scriptAgregado')
    <script src="{{ asset('js/configuracion/configuracion.js') }}"></script>
@endsection