<form role="form" id="addCliente" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="mensaje-error">
            
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombreCliente">Nombre</label>
                    <input id="nombreCliente" type="text" class="form-control" name="nombreCliente" value="" autofocus>
                    <div class="nombreCliente">
                    </div>
                </div>
                <div class="form-group">
                    <label for="dniCliente">DNI</label>
                    <input id="dniCliente" type="number" class="form-control" name="dniCliente">
                    <div class="dniCliente">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="emailCliente">Email</label>
                    <input id="emailCliente" type="email" class="form-control @error('email') is-invalid @enderror" name="emailCliente" value="{{ old('email') }}">
                    <div class="emailCliente">
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellidosCliente">Apellidos</label>
                    <input id="apellidosCliente" type="text" class="form-control" name="apellidosCliente">
                    <div class="apellidosCliente">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sexoCliente">Sexo</label>
                    <div class="checkbox">
                        <label><input name="sexoCliente" type="radio" value="0" checked style="margin-right: 10px;">Masculino</label>
                        <label><input name="sexoCliente" type="radio" value="1" style="margin-right: 10px;">Femenino</label> 
                    </div>
                    <div class="sexoCliente">
                    </div>
                </div>
                <div class="form-group">
                    <label for="celularCliente">Celular</label>
                    <input id="celularCliente" type="number" class="form-control" name="celularCliente">
                    <div class="celularCliente">
                    </div>
                </div>
            </div>
            @if (auth()->user()->tipo == 1)
            <div class="col-md-5">
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
        @if (auth()->user()->tipo == 1)
            <div class="mostrarPersonas"></div>
        @endif
    </div>
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