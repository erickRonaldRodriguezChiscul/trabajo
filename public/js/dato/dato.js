var pagina = 0;
var buscar = "";
var buscarP = "";
var idEliminar = "";

$(document).ready(function(){
//    $('#buscador').load('/inicio/contacto/miniTaxistaMostrar');
    mostrarLista("",1,"");
});

function ocultar_elemento(elemento){
    elemento.style.display = 'none';
}

function visible_elemento(elemento){
    elemento.style.display = '';
}

function mostrarPersona(query,page){
    $.ajax({
        url: "/inicio/contacto/taxistaMostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data) {
            $(".mostrarPersonas").html(data);
        }
    });
}

function mostrarLista(query,page,tipo){
    $.ajax({
        url: "/inicio/dato/mostrar",
        data: {"query":query,"page":page,"tipo":tipo},
        method: "GET",
        success: function(data){
            pagina=0;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarDato");
            visible_elemento(elemento);
            visible_elemento(elemento1);
        }
    });
}

$(document).on('click','.close',function(e){
    nombreModal = this.dataset.dismiss;
    idEliminar="";
    ocultarPopud(nombreModal);
});

$(document).on('click','.cancelarModal',function(e){
    $nombreModal = this.dataset.dismiss;
    idEliminar="";
    ocultarPopud($nombreModal);
});

$(document).on('click','#cancelar',function(e){
    document.getElementById('buscar').value="";
    mostrarLista("",1);
});

//Paginacion
$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    page = $(this).attr('href').split('page=')[1];
    if(pagina==0){
        mostrarLista(buscar,page);
    }else{
        mostrarPersona(buscar,page);
    }
});

$(document).on('click','#modal-eliminar',function(e){
    nombreModal = this.dataset.target;
    elemento = this.parentElement.parentElement.getElementsByTagName("td");
    idEliminar = this.getAttribute("attr-id");
    row= this.parentNode.parentNode.rowIndex;
    mensaje = document.getElementsByClassName("nombreEliminar")[0];
    mensaje.innerHTML = "Seguro que desea eliminar " + elemento[0].innerHTML;
    mostrarPopud(nombreModal);
});

$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/dato/eliminar",
        data: {"id":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                document.getElementById('tablaDato').rows[row].cells[4].innerText = 'Inactivo';
                $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                ocultarPopud($nombreModal);
            }
        }
    });
});

function registrarDato() {
    $.ajax({
        url: "/inicio/dato/registrar",
        method: "GET",
        success: function(data) {
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarDato");
            ocultar_elemento(elemento);
            ocultar_elemento(elemento1);
            if($(".mostrarPersonas").length){
                mostrarPersona("",1);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}

$("#contenedor").on('click','#registrarDato', function() {
    registrarDato();
});

function validaTelefono(id,e){
    var numero = document.getElementById(id).value.length;
    console.log(numero);
    if(numero==8){
        e.preventDefault();
    }
}
$(document).on('keypress','#descripcion',function(e){
    var tipo = document.getElementsByName('tipo');
    var ttipo = "";
    for(i=0; i<tipo.length; i++){
        if(tipo[i].checked){
            ttipo=tipo[i].value;
        }
    }
    console.log(ttipo);
    if(ttipo == '0'){
        validaTelefono('descripcion',e);
    }
});

function addDato() {
    var descripcion = document.getElementsByName('descripcion')[0].value;
    var tipo = document.getElementsByName('tipo');
    var token = document.getElementsByName('_token')[0].value;
    var ttipo = "";
    var tpersona = "";
    for(i=0; i<tipo.length; i++){
        if(tipo[i].checked){
            ttipo=tipo[i].value;
        }
    }

    if($(".mostrarPersonas").length){
        var persona = document.getElementsByName('persona');
        for(i=0; i<persona.length; i++){
            if(persona[i].checked){
                tpersona=persona[i].value;
            }
        }
    }

    var data = {"descripcion":descripcion,"tipo":ttipo,"idPersona":tpersona,"X-CSRF-TOKEN":token};
    console.log(data);
    $.ajax({
        url: "/inicio/dato/add",
        method: "POST",
        data: data,
        success: function(data) {
            mostrarLista("",1,"");
        },
        error: function(error) {
            console.log(error);
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
            mensaje += '<p>Errol en el envio de datos</p>';    
        } else if (textStatus === 'timeout') {
            mensaje += '<p>Error de tiempo de espera.</p>';
        } else {
            mensaje += '<p>Uncaught Error: ' + jqXHR.responseText+'</p>';
        }
        document.getElementsByClassName("mensaje-error")[0].innerHTML='<div class="alert alert-danger alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
                        '<h4>Upps!!</h4>'+mensaje+'</div>';
    });
}

$("#contenedor").on('submit','#addDato', function(event) {
    event.preventDefault();
    addDato();
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});

$(document).on('keyup','#buscarP',function(e){
    buscarP = document.getElementById('buscarP').value;
    mostrarPersona(buscarP,1);
});