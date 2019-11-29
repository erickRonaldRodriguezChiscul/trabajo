var d = new Date();
var month = d.getMonth()+1;
var day = d.getDate()+1;
var inicio =  d.getFullYear() + '/' +
(month<10 ? '0' : '') + month + '/' +
(day<10 ? '0' : '') + day;
var fin = d.getFullYear() + '/' +
(month<10 ? '0' : '') + month + '/' +
(day<10 ? '0' : '') + day;

$(document).ready(function(){
    $('#buscador').load('/inicio/programacion/mostrarPersona');
    $('#buscadorServicio').load('/inicio/programacion/mostrarServicio');
//    mostrarPersona("")
});

$(document).on('click','#limpiar',function(e){
    $('#daterange').data('daterangepicker').setStartDate((day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' +d.getFullYear());
    $('#daterange').data('daterangepicker').setEndDate((day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' + d.getFullYear());
    $('.js-example-basic-multiple').val(null).trigger('change');
});

$(document).on('click','#aceptar',function(e){
    var ban = false;
    var servicio = $('.servicios').val();
    var multiPersona = $('.js-example-basic-multiple').val();
    var token = document.getElementsByName('_token')[0].value;

    var data = {"fin":fin,"inicio":inicio,"servicio":servicio,"multiPersona":multiPersona,"X-CSRF-TOKEN":token};

    $.ajax({
        url: "/inicio/programacion/add",
        method: "POST",
        data: data,
        success: function(data) {
            console.log(data);
        },
        error: function(error) {
            $.each(error.responseJSON.errors,function(name,value){
                document.getElementsByClassName(name)[0].innerHTML='<span class="help-block" role="alert">'+
                        '<strong>'+ value[0]+'</strong></span>';
                document.getElementById(name).parentElement.className += ' has-error ';
            });
        }
    }).fail( function( jqXHR, textStatus, errorThrown ) {
        var mensaje = "";
        
        if(jqXHR.status==422){
            mensaje += "<p>Debes ingresar todos los datos.</p>";
        }else if (jqXHR.status === 0) {
            mensaje += '<p>Sin Conexion: Verifique la red.</p>';
        }else if (jqXHR.status == 500) {
            mensaje += '<p>Error al registrar los datos.</p>';    
        } else if (textStatus === 'timeout') {
            mensaje += '<p>Error de tiempo de espera.</p>';
        } else {
            mensaje += '<p>Uncaught Error: ' + jqXHR.responseText+'</p>';
        }
        document.getElementsByClassName("mensaje-error")[0].innerHTML='<div class="alert alert-danger alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
                        '<h4>Upps!!</h4>'+mensaje+'</div>';
    });
});

$('input[name="daterange"]').daterangepicker({
    opens: 'left',
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
}, function(start, end, label) {
    inicio = start.format('YYYY-MM-DD');
    fin = end.format('YYYY-MM-DD');
});

function addContacto() {
    var nombreContacto = document.getElementsByName('nombreContacto')[0].value;
    var apellidosContacto = document.getElementsByName('apellidosContacto')[0].value;
    var celularContacto = document.getElementsByName('celularContacto')[0].value;
    var token = document.getElementsByName('_token')[0].value;
    var tpersona = "";
    if($(".mostrarPersonas").length){
        var persona = document.getElementsByName('persona');
        for(i=0; i<persona.length; i++){
            if(persona[i].checked){
                tpersona=persona[i].value;
            }
        }
    }    
}

$("#contenedor").on('submit','#addContacto', function(event) {
    event.preventDefault();
    addContacto();
});