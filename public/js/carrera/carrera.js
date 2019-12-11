$(document).ready(function(){
    $('#buscadorPersona').load('/inicio/cliente/mostrarPersona');
});

function limpiar() {
    $('#direccionInicio').val("");
    $('#direccionLlegada').val("");
}

$(document).on('click','#limpiar',function(e){
    limpiar();
});

$(document).on('click','#aceptar',function(e){
    var direccionInicio = $('#direccionInicio').val();
    var direccionLlegada = $('#direccionLlegada').val();
    var idPersona = $('.js-example-basic').val();
    var token = document.getElementsByName('_token')[0].value;

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var fechaCarrera =  d.getFullYear() + '/' +
    (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day;
    
    var data = {"direccionInicio":direccionInicio,
    "direccionLlegada":direccionLlegada,
    "idPersona":idPersona,"fechaCarrera":fechaCarrera,"X-CSRF-TOKEN":token};

    $.ajax({
        url: "/inicio/cliente/addCarrera",
        method: "POST",
        data: data,
        success: function(data) {
            limpiar();
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