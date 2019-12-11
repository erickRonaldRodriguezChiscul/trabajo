<div class="form-group">
    <label for="estado">Emprendedoras</label>
    <select id="persona" class="js-example-basic form-control select2 select2-hidden-accessible" style="width: 100%;">
        @foreach ($personas as $persona)
            <option class ="persona" value="{{ $persona->id }}">{{ $persona->nombre." ".$persona->apellidos }}</option>
        @endforeach
    </select>
    <div class="persona">
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".js-example-basic").select2(); 
    });
</script>