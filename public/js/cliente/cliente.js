var pagina = 0;
var buscar = "";
var buscarP = "";
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
        url: "/inicio/cliente/mostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data){
            pagina=0;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarCliente");
            visible_elemento(elemento);
            visible_elemento(elemento1);
        }
    });
}

function registrarContenedor(){
    $.ajax({
        url: "/inicio/cliente/registrar",
        method: "GET",
        success: function(data) {
            pagina=1;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarCliente");
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

$("#contenedor").on('click','#registrarCliente', function() {
    registrarContenedor();
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

$(document).on('click','#limpiar',function(e){
    document.getElementsByName('nombreCliente')[0].value="";
    document.getElementsByName('dniCliente')[0].value="";
    document.getElementsByName('emailCliente')[0].value="";
    document.getElementsByName('apellidosCliente')[0].value="";
    document.getElementsByName('celularCliente')[0].value="";
});

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
    $("#nombreClienteEditar").parent().removeClass("has-error");
    $("#dniClienteEditar").parent().removeClass("has-error");
    $("#emailClienteEditar").parent().removeClass("has-error");
    $("#apellidosClienteEditar").parent().removeClass("has-error");
    $("#celularClienteEditar").parent().removeClass("has-error ");
    $(".nombreContactoEditar").html("");
    $(".dniClienteEditar").html("");
    $(".emailClienteEditar").html("");
    $(".apellidosClienteEditar").html("");
    $(".celularClienteEditar").html("");
    $(".mensaje-error").html("");
};

$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/cliente/eliminar",
        data: {"id":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                if(data.tipo == '2'){
                    document.getElementById('tablaCliente').deleteRow(row);
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }else{
                    document.getElementById('tablaCliente').rows[row].cells[6].innerText = 'Inactivo';
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }
            }
        }
    });
});

function addCliente() {
    var nombreCliente = document.getElementsByName('nombreCliente')[0].value;
    var dniCliente = document.getElementsByName('dniCliente')[0].value;
    var emailCliente = document.getElementsByName('emailCliente')[0].value;
    var apellidosCliente = document.getElementsByName('apellidosCliente')[0].value;
    var sexoCliente = document.getElementsByName('sexoCliente');
    var celularCliente = document.getElementsByName('celularCliente')[0].value;
    var token = document.getElementsByName('_token')[0].value;
    var tpersona = "";


    for(i=0; i<sexoCliente.length; i++){
        if(sexoCliente[i].checked){
            var tsexo=sexoCliente[i].value;
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
    
    var data = {"idPersona":tpersona,"celularCliente":celularCliente,"apellidosCliente":apellidosCliente,"emailCliente":emailCliente,"dniCliente":dniCliente,"sexoCliente":tsexo,"nombreCliente":nombreCliente,"X-CSRF-TOKEN":token};
    $.ajax({
        url: "/inicio/cliente/add",
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

$("#contenedor").on('submit','#addCliente', function(event) {
    event.preventDefault();
    addCliente();
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});

$(document).on('keyup','#buscarP',function(e){
    buscarP = document.getElementById('buscarP').value;
    mostrarPersona(buscarP,1);
});

$(document).on('click','#modal-editar',function(e){
    limpiarModalEditar();
    idEliminar = this.getAttribute("attr-id");
    $.ajax({
        url: "/inicio/cliente/recuperar",
        data: {"idEditar":idEliminar},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            if(data.cliente.length)
            {
                if($(".js-example-basic-single").length){
                    var posE = data.cliente[0].estado;
                    var estado = document.getElementsByName('estadoEditar');
                    if(posE == "S"){
                        estado[0].checked = true;
                    }else{
                        estado[1].checked = true;
                    }
                }   

                var posS = data.cliente[0].sexo;
                var sexo = document.getElementsByName('sexoClienteEditar');
                if(posS == "0"){
                    sexo[0].checked = true;
                }else{
                    sexo[1].checked = true;
                }

                document.getElementById('nombreClienteEditar').value = data.cliente[0].nombre;
                document.getElementById('apellidosClienteEditar').value = data.cliente[0].apellidos;
                document.getElementById('celularClienteEditar').value = data.cliente[0].celularCliente;
                document.getElementById('dniClienteEditar').value = data.cliente[0].dni;
                document.getElementById('emailClienteEditar').value = data.cliente[0].email;
                document.getElementById('idCliente').value = data.cliente[0].id;
                $('.js-example-basic-single').val(data.cliente[0].idPersona).trigger('change.select2');
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

$(document).on('keypress','#celularCliente',function(e){
    validaCelular('celularCliente',e);
});

$(document).on('keypress','#celularClienteEditar',function(e){
    validaCelular('celularClienteEditar',e);
});


function validaDni(id,e){
    var numero = document.getElementById(id).value.length;
    if(numero==8){
        e.preventDefault();
    }
}

$(document).on('keypress','#dniCliente',function(e){
    validaDni('dniCliente',e);
});

$(document).on('keypress','#dniClienteEditar',function(e){
    validaDni('dniClienteEditar',e);
});

$(document).on('click','#aceptarEditar',function(e){
    limpiarModalEditar();
    var nombreCliente = document.getElementsByName('nombreClienteEditar')[0].value;
    var dniCliente = document.getElementsByName('dniClienteEditar')[0].value;
    var emailCliente = document.getElementsByName('emailClienteEditar')[0].value;
    var apellidosCliente = document.getElementsByName('apellidosClienteEditar')[0].value;
    var sexoCliente = document.getElementsByName('sexoClienteEditar');
    var celularCliente = document.getElementsByName('celularClienteEditar')[0].value;
    var idCliente = document.getElementById('idCliente').value;
    var token = document.getElementsByName('_token')[0].value;
    var estado = "";
    var idPersona = "";
    var claveClienteEdita = "";
    for(i=0; i<sexoCliente.length; i++){
        if(sexoCliente[i].checked){
            var tsexo=sexoCliente[i].value;
        }
    }
    
    if($(".js-example-basic-single").length){
        claveClienteEdita = document.getElementsByName('claveClienteEditar')[0].value;
        idPersona = $('.js-example-basic-single').val();
        estado = document.getElementsByName('estadoEditar');
        for(i=0; i<estado.length; i++){
            if(estado[i].checked){
                var testado=estado[i].value;
            }
        }
    }

    var data = {"clave":claveClienteEdita,"sexoCliente":tsexo,"idCliente":idCliente,"celularCliente":celularCliente,"apellidosCliente":apellidosCliente,"emailCliente":emailCliente,"dniCliente":dniCliente,"nombreCliente":nombreCliente,"estado":testado,"idPersona":idPersona,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/cliente/editar",
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