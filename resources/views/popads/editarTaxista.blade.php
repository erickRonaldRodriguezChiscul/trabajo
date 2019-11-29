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
                            <input id="idPersona" type="text" class="form-control" name="idPersonaEditar" disabled style="display: none;">
                        <div class="form-group">
                            <label for="nameEditar">Nombre</label>
                            <input id="nameEditar" type="text" class="form-control" name="nameEditar" value="{{ old('name') }}" autofocus>
                            <div class="nameEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellidosEditar">Apellidos</label>
                            <input id="apellidosEditar" type="text" class="form-control" name="apellidosEditar">
                            <div class="apellidosEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emailEditar">Email</label>
                            <input id="emailEditar" type="email" class="form-control @error('email') is-invalid @enderror" name="emailEditar" value="{{ old('email') }}">
                            <div class="emailEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipoDocumentoEditar">Tipo de Documento</label>
                            <select id="tipoDocumentoEditar" class="form-control" name="tipoDocumentoEditar" onchange="changeEditar();">
                                <option value="0">DNI</option>
                                <option value="1">Carnet de Extranjeria</option>
                            </select>
                            <div class="tipoDocumentoEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numeroDocumentoEditar">Numero de Documento</label>
                            <input id="numeroDocumentoEditar" type="number" class="form-control" name="numeroDocumentoEditar">
                            <div class="numeroDocumentoEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passwordEditar">Clave</label>
                            <input id="passwordEditar" type="password" class="form-control" name="passwordEditar">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaEditar">Fecha Nacimiento</label>
                            <input id="fechaEditar" type="date" class="form-control" name="fechaEditar" style="margin-right: 10px;">
                            <div class="fechaEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sexoEditar">Sexo</label>
                            <div class="checkbox">
                                <label><input name="sexoEditar" type="radio" value="0" style="margin-right: 10px;">Masculino</label>
                                <label><input name="sexoEditar" type="radio" value="1" style="margin-right: 10px;">Femenino</label> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estadoEditar">Estado</label>
                            <div class="checkbox">
                                <label><input name="estadoEditar" type="radio" value="S" style="margin-right: 10px;">Activo</label>
                                <label><input name="estadoEditar" type="radio" value="N" style="margin-right: 10px;">Inactivo</label> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subirFotoEditar">foto</label>
                            <input class="form-control" id="subirFotoEditar" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirFotoEditar">
                            <div class="subirFotoEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <img id="mostrarFoto" alt="Foto" src="{{ asset('imagen/no_disponible.png') }}" width="200" height="200">
                        </div>
                    </div>
                </div>
                <div>
                    <h4>Licencia de Conducir</h4>
                    <br>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipoCategoriaEditar">Tipo de Categoria</label>
                            <select id="tipoCategoriaEditar" class="form-control" name="tipoCategoriaEditar">
                                <option value="I">I</option>
                                <option value="II-A">II-A</option>
                                <option value="II-B">II-B</option>
                                <option value="II-C">II-C</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nmrLicenciaEditar">Numero</label>
                            <input id="nmrLicenciaEditar" type="text" class="form-control" name="nmrLicenciaEditar">
                            <div class="nmrLicenciaEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaEmisionEditar">Fecha Emision</label>
                            <input id="fechaEmisionEditar" type="date" class="form-control" name="fechaEmisionEditar" style="margin-right: 10px;">
                            <div class="fechaEmisionEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaVencimientoEditar">Fecha Vencimiento</label>
                            <input id="fechaVencimientoEditar" type="date" class="form-control" name="fechaVencimientoEditar" style="margin-right: 10px;">
                            <div class="fechaVencimientoEditar">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subirBreveteEditar">Imagen de Brevete</label>
                            <input class="form-control" id="subirBreveteEditar" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirBreveteEditar">
                            <div class="subirBreveteEditar">
                            </div>
                        </div>
                        <div class="form-group">
                            <img id="mostrarFotoLicencia" alt="Foto" src="{{ asset('imagen/no_disponible.png') }}" width="200" height="200">
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