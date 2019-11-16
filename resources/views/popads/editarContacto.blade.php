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
                    <div class="col-md-4">
                        <input id="idContacto" type="text" class="form-control" name="idContactoEditar" disabled style="display: none;">
                        <div class="form-group">
                            <label for="nombreContactoEditar">Nombre</label>
                            <input id="nombreContactoEditar" type="text" class="form-control" name="nombreContactoEditar" value="{{ old('name') }}" autofocus>
                            <div class="nombreContactoEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellidosContactoEditar">Apellidos</label>
                            <input id="apellidosContactoEditar" type="text" class="form-control" name="apellidosContactoEditar">
                            <div class="apellidosContactoEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="celularContactoEditar">Celular</label>
                            <input id="celularContactoEditar" type="number" class="form-control" name="celularContactoEditar">
                            <div class="celularContactoEditar">
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->tipo == 1)
                        <div class="col-md-6">
                            <div id="buscador"></div>
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