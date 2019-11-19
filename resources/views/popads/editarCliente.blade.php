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
                            <input id="idCliente" type="text" class="form-control" name="idCliente" disabled style="display: none;">
                            <div class="form-group">
                                <label for="nombreClienteEditar">Nombre</label>
                                <input id="nombreClienteEditar" type="text" class="form-control" name="nombreClienteEditar" value="" autofocus>
                                <div class="nombreClienteEditar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dniClienteEditar">DNI</label>
                                <input id="dniClienteEditar" type="number" class="form-control" name="dniClienteEditar">
                                <div class="dniClienteEditar">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emailClienteEditar">Email</label>
                                <input id="emailClienteEditar" type="email" class="form-control @error('email') is-invalid @enderror" name="emailClienteEditar" value="{{ old('email') }}">
                                <div class="emailClienteEditar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apellidosClienteEditar">Apellidos</label>
                                <input id="apellidosClienteEditar" type="text" class="form-control" name="apellidosClienteEditar">
                                <div class="apellidosClienteEditar">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="celularClienteEditar">Celular</label>
                                <input id="celularClienteEditar" type="number" class="form-control" name="celularClienteEditar">
                                <div class="celularClienteEditar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sexoClienteEditar">Sexo</label>
                                <div class="checkbox">
                                    <label><input name="sexoClienteEditar" type="radio" value="0" checked style="margin-right: 10px;">Masculino</label>
                                    <label><input name="sexoClienteEditar" type="radio" value="1" style="margin-right: 10px;">Femenino</label> 
                                </div>
                                <div class="sexoClienteEditar">
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->tipo == 1)
                            <div class="col-md-4">
                                <div id="buscador"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="claveClienteEditar">Clave</label>
                                    <input id="claveClienteEditar" type="password" class="form-control" name="claveClienteEditar">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estadoEditar">Estado</label>
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