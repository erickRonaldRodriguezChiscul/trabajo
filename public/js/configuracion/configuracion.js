function igualdad(nuevo){
    var verificar =  $("#verificarPassword").val();
    if(verificar==nuevo){
        return true;
    }else{
        return false;
    }
}

$("#verificarPassword").keyup(function(){
    nuevo = $("#nuevoPassword").val();
    if(nuevo == ""){
        document.getElementsByClassName('nuevoPassword')[0].innerHTML='<span class="help-block" role="alert">'+
                        '<strong>Ingrese nueva Contraseña</strong></span>';
        document.getElementsByName('nuevoPassword')[0].parentElement.parentElement.className += ' has-error ';
    }else{
        if(igualdad(nuevo)){
            $("#verificarPassword").parent().parent().removeClass("has-error ");
            $(".verificarPassword").html("");
            $("#nuevoPassword").parent().parent().removeClass("has-error ");
            $(".nuevoPassword").html("");
        }else{
            document.getElementsByClassName('verificarPassword')[0].innerHTML='<span class="help-block" role="alert">'+
                        '<strong>Contraseña debe ser igual</strong></span>';
            document.getElementsByName('verificarPassword')[0].parentElement.parentElement.className += ' has-error ';
        }
    }
});

$("#iconNuevo").mousedown(function(){
    $("#nuevoPassword").removeAttr('type');
});

$("#iconNuevo").mouseup(function(){
    $("#nuevoPassword").attr('type','password');
});

$("#iconVerificar").mousedown(function(){
    $("#verificarPassword").removeAttr('type');
});

$("#iconVerificar").mouseup(function(){
    $("#verificarPassword").attr('type','password');
});


function limpiar(){
    $("#verificarPassword").val("");
    $("#nuevoPassword").val("");
    $("#passwordActual").val("");
}

function addConfiguracion(){
    var verificar = $("#verificarPassword").val();
    var nuevo = $("#nuevoPassword").val();
    var actual = $("#passwordActual").val();
    var token = document.getElementsByName('_token')[0].value;

    if(nuevo == verificar && nuevo != "" && verificar != "" && actual!= ""){
        $.ajax({
            url: "/inicio/configuracion/cambiar",
            data: {"nuevo":nuevo,"actual":actual,"X-CSRF-TOKEN":token},
            method: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.estado == 'ok'){
                    $(".mensaje-error").html('<div class="alert alert-success alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
                    '<h4>Upps!!</h4>Contraseña Modificada</div>');
                    limpiar();
                }else{
                    $(".mensaje-error").html('<div class="alert alert-danger alert-dismissible">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
                    '<h4>Aceptado</h4>Contraseña actual no coincide</div>');
                }
            }
        });
    }else{
        if(actual== ""){
            $(".mensaje-error").html('<div class="alert alert-danger alert-dismissible">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
            '<h4>Upps!!</h4>Ingrese la contraseña actual</div>');
        }else{
            $(".mensaje-error").html('<div class="alert alert-danger alert-dismissible">'+
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
            '<h4>Upps!!</h4>La nueva contraseña y verificación deben ser iguales</div>');
        }
    }
    
};

$("#contenedor").on('submit','#addConfiguracion', function(event) {
    event.preventDefault();
    addConfiguracion();
});
