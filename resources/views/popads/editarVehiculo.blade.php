<div class="modal modal-editar fade in" data-dismiss="modal-editar" style="overflow: auto;display: none;padding-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal-editar" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <H4 class="modal-title">EDITAR</H4>
            </div>
            <div class="modal-body">
                <div class="mensaje-error">
        
                </div>
                <div class="row">
                        <input id="idVehiculo" type="text" class="form-control" name="idContactoEditar" disabled style="display: none;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="marcaVehiculoEditar">Marca</label>
                            <input id="marcaVehiculoEditar" type="text" class="form-control" name="marcaVehiculoEditar" value="" autofocus>
                            <div class="marcaVehiculoEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="yearFabricacionEditar">Año de Fabricacion</label>
                            <input id="yearFabricacionEditar" type="date" class="form-control" name="yearFabricacionEditar">
                            <div class="yearFabricacionEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="placaVehiculoEditar">Placa</label>
                            <input id="placaVehiculoEditar" type="text" class="form-control" name="placaVehiculoEditar">
                            <div class="placaVehiculoEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="soatEditar">SOAT</label>
                            <input id="soatEditar" type="text" class="form-control" name="soatEditar">
                            <div class="soatEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipoVehiculoEditar">Tipo</label>
                            <select class="form-control" id="tipoVehiculoEditar" name="tipoVehiculoEditar">
                                <option value="0">Automovil</option>
                                <option value="1">Motocicleta</option>
                            </select>
                            <div class="tipoVehiculoEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="revisionTecnicaEditar">Revision Tecnica</label>
                            <input id="revisionTecnicaEditar" type="text" class="form-control" name="revisionTecnicaEditar">
                            <div class="revisionTecnicaEditar">
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->tipo == 1)
                        <div class="col-md-6">
                            <div id="buscador"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <div class="checkbox">
                                    <label><input name="estadoEditar" type="radio" value="S" style="margin-right: 10px;">Activo</label>
                                    <label><input name="estadoEditar" type="radio" value="N" style="margin-right: 10px;">Inactivo</label> 
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left cancelarModal" data-dismiss="modal-editar">
                    Cancelar
                </button>
                <button type="button" id="aceptarEditar" data-dismiss="modal-danger" class="btn btn-primary">Editar</button>
            </div>
        </div>
    </div>
</div>