<form role="form" id="addTarifa" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="mensaje-error">
            
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombreTarifa">Nombre</label>
                    <input id="nombreTarifa" type="text" class="form-control" name="nombreTarifa" value="" autofocus>
                    <div class="nombreTarifa">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="porcentajeTarifa">Porcentaje de Ganancia</label>
                    <input id="porcentajeTarifa" type="number" class="form-control" name="porcentajeTarifa">
                    <div class="porcentajeTarifa">
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