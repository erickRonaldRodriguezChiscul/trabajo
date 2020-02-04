<div class="form-group">
    <label for="estado">Servicio</label>
    <select data-select2-id="9" tabindex="-1" aria-hidden="true" name="servicios" class="serviciosPopads form-control select2 select2-hidden-accessible" style="width: 100%;">
        @foreach ($servicios as $servicio)
            <option value="{{ $servicio->idServicio }}">{{ $servicio->nombreServicio." S/.".$servicio->importe }}</option>
        @endforeach
    </select>
</div>
<script>
    $(document).ready(function(){
        $(".serviciosPopads").select2(); 
    });
</script>