<div class="form-group">
    <label for="estado">Emprendedoras</label>
    <select data-select2-id="id_label_multiple" tabindex="1" aria-hidden="true" multiple="multiple" class="editar-multiple js-states form-control select2-hidden-accessible" style="width: 100%;">
        @foreach ($personas as $persona)
            <option class ="persona" value="{{ $persona->id }}">{{ $persona->nombre." ".$persona->apellidos }}</option>
        @endforeach
    </select>
    <div class="multiPersonaEditar">
    </div>
</div>
<script>
$(document).ready(function(){
    $(".editar-multiple").select2(); 
});
</script>