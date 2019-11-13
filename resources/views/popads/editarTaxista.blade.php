<div class="modal modal-editar fade in" data-dismiss="modal-editar" style="display: none; padding-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal-editar" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <H4 class="modal-title">EDITAR</H4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                            <div class="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input id="apellidos" type="text" class="form-control" name="apellidos">
                            <div class="apellidos">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha Nacimiento</label>
                            <input id="fecha" type="date" class="form-control" name="fecha" style="margin-right: 10px;">
                            <div class="fecha">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            <div class="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input id="dni" type="number" class="form-control" name="dni">
                            <div class="dni">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dni">Clave</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <div class="checkbox">
                                <label><input name="sexo" type="radio" value="0" checked style="margin-right: 10px;">Masculino</label>
                                <label><input name="sexo" type="radio" value="1" style="margin-right: 10px;">Femenino</label> 
                            </div>
                            <div class="sexo">
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