<form enctype="multipart/form-data" method="POST" id="addTaxista">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="mensaje-error">
                
        </div>
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
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    <div class="email">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipoDocumento">Tipo de Documento</label>
                    <select id="tipoDocumento" class="form-control" name="tipoDocumento" onchange="change();">
                        <option value="0">DNI</option>
                        <option value="1">Carnet de Extranjeria</option>
                    </select>
                    <div class="tipoDocumento">
                    </div>
                </div>
                <div class="form-group">
                    <label for="numeroDocumento">Numero de Documento</label>
                    <input id="numeroDocumento" type="number" class="form-control" name="numeroDocumento">
                    <div class="numeroDocumento">
                    </div>
                </div>
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fecha">Fecha Nacimiento</label>
                    <input id="fecha" type="date" class="form-control" name="fecha" style="margin-right: 10px;">
                    <div class="fecha">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subirFoto">foto</label>
                    <input class="form-control" id="subirFoto" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirFoto">
                    <div class="subirFoto">
                    </div>
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
                    <label for="tipoCategoria">Tipo de Categoria</label>
                    <select class="form-control" name="tipoCategoria">
                        <option value="I">I</option>
                        <option value="II-A">II-A</option>
                        <option value="II-B">II-B</option>
                        <option value="II-C">II-C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nmrLicencia">Numero</label>
                    <input id="nmrLicencia" type="text" class="form-control" name="nmrLicencia">
                    <div class="nmrLicencia">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fechaEmision">Fecha Emision</label>
                    <input id="fechaEmision" type="date" class="form-control" name="fechaEmision" style="margin-right: 10px;">
                    <div class="fechaEmision">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fechaVencimiento">Fecha Vencimiento</label>
                    <input id="fechaVencimiento" type="date" class="form-control" name="fechaVencimiento" style="margin-right: 10px;">
                    <div class="fechaVencimiento">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subirBrevete">Imagen de Brevete</label>
                    <input class="form-control" id="subirBrevete" type="file" accept="image/x-png,image/gif,image/jpeg" name="subirBrevete">
                    <div class="subirBrevete">
                    </div>
                </div>
            </div>
        </div>
    </div>
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