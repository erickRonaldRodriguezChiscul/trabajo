<form role="form" id="addTaxista" action="#">
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
                <div class="form-group">
                    <label for="fecha">Fecha Nacimiento</label>
                    <input id="fecha" type="date" class="form-control" name="fecha" style="margin-right: 10px;">
                    <div class="fecha">
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