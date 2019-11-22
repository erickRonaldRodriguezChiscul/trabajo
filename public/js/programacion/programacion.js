$(document).ready(function(){
    $('#buscador').load('/inicio/programacion/mostrarPersona');
    $('#buscadorServicio').load('/inicio/programacion/mostrarServicio');
//    mostrarPersona("")
});

$(document).on('click','#aceptar',function(e){
    idPersona = $('.servicios').val();
    multiple = $('.js-example-basic-multiple').val();
    console.log(multiple);
    console.log(idPersona);
});

/*function mostrarServicio(query,page){
    $.ajax({
        url: "/inicio/programacion/mostrarServicio",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data) {
            $(".mostrarPersonas").html(data);
        }
    });
}

$(document).on('keyup','#buscarP',function(e){
    buscarP = document.getElementById('buscarP').value;
    mostrarPersona(buscarP,1);
});

function mostrarPersona(query,page){
    $.ajax({
        url: "/inicio/contacto/taxistaMostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data) {
            $(".mostrarPersonas").html(data);
        }
    });
}*/

$('input[name="daterange"]').daterangepicker({
    "locale":{
        "format":"DD/MM/YYYY",
        "applyLabel": "Aplicar",
        "canceLabel": "Cancelar",
        "daysOfWeek":[
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames":[
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay":1
    }
});