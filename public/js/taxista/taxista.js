var buscar = "";
$(document).ready(function(){
    mostrarLista("",1);
});

function ocultar_elemento(elemento) {
    elemento.style.display = 'none';
}

function visible_elemento(elemento) {
    elemento.style.display = '';
}

function mostrarLista(query,page){
    $.ajax({
        url: "/inicio/taxista/mostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data) {
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarTaxista");
            visible_elemento(elemento);
            visible_elemento(elemento1);
        }
    });
}

function registrarTaxista() {
    $.ajax({
        url: "/inicio/taxista/registrar",
        method: "GET",
        success: function(data) {
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarTaxista");
            ocultar_elemento(elemento);
            ocultar_elemento(elemento1);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function addTaxista() {
    var name = document.getElementsByName('name')[0].value;
    var email = document.getElementsByName('email')[0].value;
    var apellidos = document.getElementsByName('apellidos')[0].value;
    var dni = document.getElementsByName('dni')[0].value;
    var fecha = document.getElementsByName('fecha')[0].value;
    var sexo = document.getElementsByName('sexo');
    var token = document.getElementsByName('_token')[0].value;
    
    for(i=0; i<sexo.length; i++){
        if(sexo[i].checked){
            var tsexo=sexo[i].value;
        }
    }
    var data = {"sexo":tsexo,"fecha":fecha,"email":email,"apellidos":apellidos,"dni":dni,"name":name,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/taxista/add",
        method: "POST",
        data: data,
        dataType:"json",
        success: function(data) {
            mostrarLista("");
        },
        error: function(error) {
            $.each(error.responseJSON.errors,function(name,value){
                document.getElementsByClassName(name)[0].innerHTML='<span class="help-block" role="alert">'+
                        '<strong>'+ value[0]+'</strong></span>';
                document.getElementsByName(name)[0].parentElement.className += ' has-error ';
            });
        }
    }).fail( function( jqXHR, textStatus, errorThrown ) {
        var mensaje = "";
        
        if(jqXHR.status==422){
            mensaje += "<p>Debes ingresar todos los datos.</p>";
        }else if (jqXHR.status === 0) {
            mensaje += '<p>Sin Conexion: Verifique la red.</p>';
        }else if (jqXHR.status == 500) {
            mensaje += '<p>Email ya existe</p>';    
        } else if (textStatus === 'timeout') {
            mensaje += '<p>Error de tiempo de espera.</p>';
        } else {
            mensaje += '<p>Uncaught Error: ' + jqXHR.responseText+'</p>';
        }
        console.log(jqXHR.status==422);
        document.getElementsByClassName("mensaje-error")[0].innerHTML='<div class="alert alert-danger alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
                        '<h4>Upps!!</h4>'+mensaje+'</div>';
    });
}

$("#contenedor").on('click','#registrarTaxista', function() {
    registrarTaxista();
});

$("#contenedor").on('submit','#addTaxista', function(event) {
    event.preventDefault();
    addTaxista();
});

//Paginacion
$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    page = $(this).attr('href').split('page=')[1];
    mostrarLista(buscar,page);
});

$(document).on('click','#cancelar',function(e){
    mostrarLista("",1);
});

$(document).on('click','#limpiar',function(e){
    document.getElementsByName('name')[0].value="";
    document.getElementsByName('email')[0].value="";
    apellidos = document.getElementsByName('apellidos')[0].value="";
    document.getElementsByName('dni')[0].value="";
    fecha = document.getElementsByName('fecha')[0].value="";
});

$(document).on('keypress','#dni',function(e){
    var numero = document.getElementById('dni').value.length;
    console.log(numero);
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});