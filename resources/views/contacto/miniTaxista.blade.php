<div class="form-group">
    <label for="estado">Persona</label>
    <select name="js-example-basic-single" class="js-example-basic-single form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
        @foreach ($personas as $persona)
            <option value="{{ $persona->id }}">{{ $persona->nombre." ".$persona->apellidos }}</option>
        @endforeach
    </select>
</div>
<script>
    $(document).ready(function(){
        $(".js-example-basic-single").select2(); 
    });
</script>