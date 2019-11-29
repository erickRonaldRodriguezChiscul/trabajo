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
                    <label for="modeloVehiculo">Modelo</label>
                    <input id="modeloVehiculo" type="text" class="form-control" name="modeloVehiculo">
                    <div class="modeloVehiculo">
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
                    <label for="subirPropiedad">Tarjeta de Propiedad</label>
                    <input class="form-control" id="subirPropiedad" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirPropiedad">
                    <div class="subirPropiedad">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h4>Revisión Tecnica</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="entidadRevision">Entidad</label>
                    <input id="entidadRevision" type="text" class="form-control" name="entidadRevision">
                    <div class="entidadRevision">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subirRevision">Foto</label>
                    <input class="form-control" id="subirRevision" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirRevision">
                    <div class="subirRevision">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fechaVencimientoRevision">Fecha de Vencimiento</label>
                    <input id="fechaVencimientoRevision" type="date" class="form-control" name="fechaVencimientoRevision">
                    <div class="fechaVencimientoRevision">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input id="observaciones" type="text" class="form-control" name="observaciones">
                    <div class="observaciones">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h4>soat</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="entidadSoat">Entidad</label>
                    <input id="entidadSoat" type="text" class="form-control" name="entidadSoat">
                    <div class="entidadSoat">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fechaVencimientoSoat">Fecha de Vencimiento</label>
                    <input id="fechaVencimientoSoat" type="date" class="form-control" name="fechaVencimientoSoat">
                    <div class="fechaVencimientoSoat">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subirSoat">Foto</label>
                    <input class="form-control" id="subirSoat" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirSoat">
                    <div class="subirSoat">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h4>Seguro contra Riesgo</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="entidadSeguro">Entidad</label>
                    <input id="entidadSeguro" type="text" class="form-control" name="entidadSeguro">
                    <div class="entidadSeguro">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fechaVencimientoSeguro">Fecha de Vencimiento</label>
                    <input id="fechaVencimientoSeguro" type="date" class="form-control" name="fechaVencimientoSeguro">
                    <div class="fechaVencimientoSeguro">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subirSeguro">Foto</label>
                    <input class="form-control" id="subirSeguro" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirSeguro">
                    <div class="subirSeguro">
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user()->tipo == 1)
            <div class="row">
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
            </div>
        @endif
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