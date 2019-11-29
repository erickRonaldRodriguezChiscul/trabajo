var pagina = 0;
var buscar = "";
var buscarP = "";
var idEliminar = "";

$(document).ready(function(){
    $('#buscador').load('/inicio/contacto/miniTaxistaMostrar');
    mostrarLista("",1);
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

function mostrarLista(query,page){
    $.ajax({
        url: "/inicio/contacto/mostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data){
            pagina=0;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarContacto");
            visible_elemento(elemento);
            visible_elemento(elemento1);
        }
    });
}

function registrarContenedor(){
    $.ajax({
        url: "/inicio/contacto/registrar",
        method: "GET",
        success: function(data) {
            pagina=1;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarContacto");
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

$("#contenedor").on('click','#registrarContacto', function() {
    registrarContenedor();
});

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

$(document).on('click','#limpiar',function(e){
    document.getElementsByName('nombreContacto')[0].value="";
    document.getElementsByName('apellidosContacto')[0].value="";
    document.getElementsByName('celularContacto')[0].value="";
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
    
    var data = {"idPersona":tpersona,"celularContacto":celularContacto,"apellidosContacto":apellidosContacto,"nombreContacto":nombreContacto,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/contacto/add",
        method: "POST",
        data: data,
        success: function(data) {
            mostrarLista("",1);
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
        document.getElementsByClassName("mensaje-error")[0].innerHTML='<div class="alert alert-danger alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
                        '<h4>Upps!!</h4>'+mensaje+'</div>';
    });
}

$("#contenedor").on('submit','#addContacto', function(event) {
    event.preventDefault();
    addContacto();
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

function limpiarModalEditar(){
    $("#nombreContactoEditar").parent().removeClass("has-error");
    $("#apellidosContactoEditar").parent().removeClass("has-error");
    $("#celularContactoEditar").parent().removeClass("has-error ");
    $(".nombreContactoEditar").html("");
    $(".apellidosContactoEditar").html("");
    $(".celularContactoEditar").html("");
    $(".mensaje-error").html("");
};

$(document).on('click','#modal-editar',function(e){
    limpiarModalEditar();
    idEliminar = this.getAttribute("attr-id");
    $.ajax({
        url: "/inicio/contacto/recuperar",
        data: {"idEditar":idEliminar},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            if(data.contacto.length)
            {
                if($(".js-example-basic-single").length){
                    var posE = data.contacto[0].estado;
                    var estado = document.getElementsByName('estadoEditar');
                    if(posE == "S"){
                        estado[0].checked = true;
                    }else{
                        estado[1].checked = true;
                    }
                }
                document.getElementById('nombreContactoEditar').value = data.contacto[0].nombreContacto;
                document.getElementById('apellidosContactoEditar').value = data.contacto[0].apellidosContacto;
                document.getElementById('celularContactoEditar').value = data.contacto[0].celularContacto;
                document.getElementById('idContacto').value = data.contacto[0].id;
                $('.js-example-basic-single').val(data.contacto[0].idTaxista).trigger('change.select2');
                mostrarPopud("modal-editar");
            }
        }
    });
});

function validaCelular(id,e){
    var numero = document.getElementById(id).value.length;
    if(numero==9){
        e.preventDefault();
    }
}

$(document).on('keypress','#celularContacto',function(e){
    validaCelular('celularContacto',e);
});

$(document).on('keypress','#celularContactoEditar',function(e){
    validaCelular('celularContactoEditar',e);
});

$(document).on('click','#aceptarEditar',function(e){
    limpiarModalEditar();
    var nombreContacto = document.getElementById('nombreContactoEditar').value;
    var apellidosContacto = document.getElementById('apellidosContactoEditar').value;
    var celularContacto = document.getElementById('celularContactoEditar').value;
    var idContacto = document.getElementById('idContacto').value;
    var token = document.getElementsByName('_token')[0].value;
    var estado = "";
    var idPersona = "";
    
    if($(".js-example-basic-single").length){
        idPersona = $('.js-example-basic-single').val();
        estado = document.getElementsByName('estadoEditar');
        for(i=0; i<estado.length; i++){
            if(estado[i].checked){
                var testado=estado[i].value;
            }
        }
    }

    var data = {"estado":testado,"idPersona":idPersona,"idContacto":idContacto,"celularContacto":celularContacto,"apellidosContacto":apellidosContacto,"nombreContacto":nombreContacto,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/contacto/editar",
        method: "POST",
        data: data,
        success: function(data) {
            mostrarLista("",1);
            ocultarPopud("modal-editar");
        },
        error: function(error) {
            $.each(error.responseJSON.errors,function(name,value){
                document.getElementsByClassName(name+"Editar")[0].innerHTML='<span class="help-block" role="alert">'+
                        '<strong>'+ value[0]+'</strong></span>';
                document.getElementsByName(name+"Editar")[0].parentElement.className += ' has-error ';
            });
        }
    }).fail( function( jqXHR, textStatus, errorThrown ) {
        var mensaje = "";
        if(jqXHR.status==422){
            mensaje += "<p>Debes ingresar todos los datos.</p>";
        }else if (jqXHR.status === 0) {
            mensaje += '<p>Sin Conexion: Verifique la red.</p>';
        }else if (textStatus === 'timeout') {
            mensaje += '<p>Error de tiempo de espera.</p>';
        } else {
            mensaje += '<p>Uncaught Error: ' + jqXHR.responseText+'</p>';
        }
        console.log(jqXHR.status==422);
        document.getElementsByClassName("mensaje-error")[0].innerHTML='<div class="alert alert-danger alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'+
                        '<h4>Upps!!</h4>'+mensaje+'</div>';
    });
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});

$(document).on('keyup','#buscarP',function(e){
    buscarP = document.getElementById('buscarP').value;
    mostrarPersona(buscarP,1);
});


$(document).on('click','#modal-eliminar',function(e){
    nombreModal = this.dataset.target;
    elemento = this.parentElement.parentElement.getElementsByTagName("td");
    idEliminar = this.getAttribute("attr-id");
    row= this.parentNode.parentNode.rowIndex;
    mensaje = document.getElementsByClassName("nombreEliminar")[0];
    mensaje.innerHTML = "Seguro que desea eliminar el registro de " + elemento[0].innerHTML;
    mostrarPopud(nombreModal);
});

$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/contacto/eliminar",
        data: {"id":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                if(data.tipo == '2'){
                    document.getElementById('tablaContacto').deleteRow(row);
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }else{
                    document.getElementById('tablaContacto').rows[row].cells[4].innerText = 'Inactivo';
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }
            }
        }
    });
});