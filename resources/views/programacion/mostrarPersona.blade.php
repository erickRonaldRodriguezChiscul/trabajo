<div class="form-group">
    <label for="estado">Emprendedoras</label>
    <select id="multiPersona"  data-select2-id="7" tabindex="-1" aria-hidden="true" name="states[]" multiple="multiple" class="js-example-basic-multiple form-control select2 select2-hidden-accessible" style="width: 100%;">
        <option class ="persona" value="-1">Todos</option>
        @foreach ($personas as $persona)
            <option class ="persona" value="{{ $persona->id }}">{{ $persona->nombre." ".$persona->apellidos }}</option>
        @endforeach
    </select>
    <div class="multiPersona">
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".js-example-basic-multiple").select2();
    });
</script>