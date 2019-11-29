<form role="form" id="addDato" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="mensaje-error">
            
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('name') }}" autofocus>
                    <div class="descripcion">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <div class="checkbox">
                        <label><input name="tipo" type="radio" value="0" checked style="margin-right: 10px;">Telefono</label>
                        <label><input name="tipo" type="radio" value="1" style="margin-right: 10px;">Dirección</label> 
                    </div>
                    <div class="tipo">
                    </div>
                </div>
            </div>
            <br>
            @if (auth()->user()->tipo == 1)
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="input-group" name="idPersona">
                            <input type="text" id="buscarP" class="form-control" placeholder="Buscar">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="idPersona">
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if (auth()->user()->tipo == 1)
            <div class="mostrarPersonas"></div>
        @endif
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