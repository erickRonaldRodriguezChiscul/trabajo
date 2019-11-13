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
                            <input id="idPersona" type="text" class="form-control" name="idPersonaEditar" disabled>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="nameEditar" type="text" class="form-control" name="nameEditar" value="{{ old('name') }}" autofocus>
                            <div class="nameEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input id="apellidosEditar" type="text" class="form-control" name="apellidosEditar">
                            <div class="apellidosEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha Nacimiento</label>
                            <input id="fechaEditar" type="date" class="form-control" name="fechaEditar" style="margin-right: 10px;">
                            <div class="fechaEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="emailEditar" type="email" class="form-control @error('email') is-invalid @enderror" name="emailEditar" value="{{ old('email') }}">
                            <div class="emailEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input id="dniEditar" type="number" class="form-control" name="dniEditar">
                            <div class="dniEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dni">Clave</label>
                            <input id="passwordEditar" type="password" class="form-control" name="passwordEditar">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <div class="checkbox">
                                <label><input name="sexoEditar" type="radio" value="0" style="margin-right: 10px;">Masculino</label>
                                <label><input name="sexoEditar" type="radio" value="1" style="margin-right: 10px;">Femenino</label> 
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="estado">Estado</label>
                                <div class="checkbox">
                                    <label><input name="estadoEditar" type="radio" value="S" style="margin-right: 10px;">Activo</label>
                                    <label><input name="estadoEditar" type="radio" value="N" style="margin-right: 10px;">Inactivo</label> 
                                </div>
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