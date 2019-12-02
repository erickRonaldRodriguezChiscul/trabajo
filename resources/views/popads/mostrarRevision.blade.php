<div class="modal modal-historial fade in" data-dismiss="modal-historial" style="overflow: auto;display: none;padding-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal-historial" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <H4 class="modal-title">Historial</H4>
            </div>
            <div class="modal-body">
                <div class="mensaje-error">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input id="idVehiculo" type="text" class="form-control" disabled style="display: none;">
                        <div class="form-group">
                            <label for="entidadRevision">Entidad</label>
                            <input id="entidadRevision" type="text" class="form-control" name="entidadRevision">
                            <div class="entidadRevision">
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subirRevision">Foto</label>
                            <input class="form-control" id="subirRevision" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirRevision">
                            <div class="subirRevision">
                            </div>
                        </div>
                        <div class="form-group">
                            <img id="mostrarFoto" alt="Foto" src="{{ asset('imagen/no_disponible.png') }}" width="200" height="200">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id="buscarP" class="form-control" placeholder="Buscar">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="idRevision"  style="overflow: auto;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left cancelarModal" data-dismiss="modal-historial">
                    Cancelar
                </button>
                <button type="button" id="aceptarRegistrar" data-dismiss="modal-danger" class="btn btn-success">agregar</button>
                <button type="button" id="aceptarEditar" data-dismiss="modal-danger" class="btn btn-primary" disabled>Editar</button>
                <button type="button" id="aceptarlimpiar" data-dismiss="modal-danger" class="btn btn-default">Limpiar</button>
            </div>
        </div>
    </div>
</div>