<form role="form" id="addContacto" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="mensaje-error">
            
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="marcaVehiculo">Marca</label>
                    <input id="marcaVehiculo" type="text" class="form-control" name="marcaVehiculo" value="" autofocus>
                    <div class="marcaVehiculo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="yearFabricacion">Año de Fabricacion</label>
                    <input id="yearFabricacion" type="date" class="form-control" name="yearFabricacion">
                    <div class="yearFabricacion">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="placaVehiculo">Placa</label>
                    <input id="placaVehiculo" type="text" class="form-control" name="placaVehiculo">
                    <div class="placaVehiculo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="soat">SOAT</label>
                    <input id="soat" type="text" class="form-control" name="soat">
                    <div class="soat">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipoVehiculo">Tipo</label>
                    <select class="form-control" id="tipoVehiculo" name="tipoVehiculo">
                        <option value="0">Automovil</option>
                        <option value="1">Motocicleta</option>
                    </select>
                    <div class="tipoVehiculo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="revisionTecnica">Revision Tecnica</label>
                    <input id="revisionTecnica" type="text" class="form-control" name="revisionTecnica">
                    <div class="revisionTecnica">
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