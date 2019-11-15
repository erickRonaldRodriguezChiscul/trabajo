<form role="form" id="addContacto" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="mensaje-error">
            
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombreContacto">Nombre</label>
                    <input id="nombreContacto" type="text" class="form-control" name="nombreContacto" value="" autofocus>
                    <div class="nombreContacto">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="apellidosContacto">Apellidos</label>
                    <input id="apellidosContacto" type="text" class="form-control" name="apellidosContacto">
                    <div class="apellidosContacto">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="celularContacto">Celular</label>
                    <input id="celularContacto" type="number" class="form-control" name="celularContacto">
                    <div class="celularContacto">
                    </div>
                </div>
            </div>
            @if (auth()->user()->tipo == 1)
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group" name="idPersona">
                        <input type="text" id="buscarP" class="form-control" placeholder="Buscar">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="idPersona">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @if (auth()->user()->tipo == 1)
        <div class="mostrarPersonas"></div>
    @endif
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">
            Registrar
        </button>
        <button id="limpiar" type="button" class="btn btn-success">
            Limpiar
        </button>
        <button id="cancelar" type="button" class="btn btn-default pull-right">
            Cancelar
        </button>
    </div>
</form>