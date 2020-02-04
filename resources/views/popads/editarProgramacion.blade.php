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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estadoEditar">Estado</label>
                                <div class="checkbox">
                                    <label><input name="estadoEditar" type="radio" value="S" style="margin-right: 10px;">Activo</label>
                                    <label><input name="estadoEditar" type="radio" value="N" style="margin-right: 10px;">Inactivo</label> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input id="idServicio" type="text" class="form-control" name="idServicio" disabled style="display: none;">
                            <div class="form-group">
                                <label for="daterangeEditar">Rango de Fecha</label>
                                <input id="daterangeEditar" class="form-control" type="text" name="daterange"/>
                                <div class="daterangeEditar">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="buscadorEditar">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="buscadorServicioEditar">
                            </div>
                        </div>
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