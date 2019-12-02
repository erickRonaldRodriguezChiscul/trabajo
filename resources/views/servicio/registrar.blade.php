<form role="form" id="addServicio" action="#">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="box-body">
        <div class="mensaje-error">
            
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipoServicio">tipo</label>
                    <select name="tipoServicio" class="form-control" id="tipoServicio">
                        <option value="0">Interno</option>
                        <option value="1">Externo</option>
                    </select>
                    <div class="tipoServicio">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nombreServicio">Nombre</label>
                    <input id="nombreServicio" type="text" class="form-control" name="nombreServicio" value="" autofocus>
                    <div class="nombreServicio">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="importeServicio">Importe</label>
                    <input id="importeServicio" type="text" class="form-control" name="importeServicio" onkeypress="return filterFloat(event,this);">
                    <div class="importeServicio">
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