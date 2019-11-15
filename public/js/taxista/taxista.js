var buscar = "";
var idEliminar = "";
var row = "";
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
    document.getElementById('buscar').value="";
    mostrarLista("",1);
});

function validaDni(id,e){
    var numero = document.getElementById(id).value.length;
    if(numero==8){
        e.preventDefault();
    }
}
$(document).on('keypress','#dni',function(e){
    validaDni('dni',e);
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});

$(document).on('click','#limpiar',function(e){
    document.getElementsByName('name')[0].value="";
    document.getElementsByName('email')[0].value="";
    apellidos = document.getElementsByName('apellidos')[0].value="";
    document.getElementsByName('dni')[0].value="";
    fecha = document.getElementsByName('fecha')[0].value="";
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
/*
$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/taxista/eliminar",
        data: {"id":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                document.getElementById('tablaTaxis').deleteRow(row);
                $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                ocultarPopud($nombreModal);
            }
        }
    });
});*/

$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/taxista/eliminar",
        data: {"id":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                document.getElementById('tablaTaxis').rows[row].cells[4].innerText = 'Inactivo';
                $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                ocultarPopud($nombreModal);
            }
        }
    });
});

$(document).on('keypress','#dniEditar',function(e){
    validaDni('dniEditar',e);
});

//modal Editar
function limpiarModalEditar(){
    $(".nameEditar").html("");
    $(".apellidosEditar").html("");
    $(".fechaEdita").html("");
    $(".emailEditar").html("");
    $(".dniEditar").html("");
    $("#nameEditar").parent().removeClass("has-error");
    $("#apellidosEditar").parent().removeClass("has-error");
    $("#fechaEdita").parent().removeClass("has-error ");
    $("#emailEditar").parent().removeClass("has-error ");
    $("#dniEditar").parent().removeClass("has-error ");
    $(".mensaje-error").html("");
};

$(document).on('click','#modal-editar',function(e){
    limpiarModalEditar();
    idEliminar = this.getAttribute("attr-id");
    $.ajax({
        url: "/inicio/taxista/recuperar",
        data: {"idEditar":idEliminar},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            if(data.persona.length)
            {
                var pos = data.persona[0].sexo;
                var sexo = document.getElementsByName('sexoEditar');
                sexo[pos].checked = true;
                var posE = data.persona[0].estado;
                var estado = document.getElementsByName('estadoEditar');
                if(posE == "S"){
                    estado[0].checked = true;
                }else{
                    estado[1].checked = true;
                }
                document.getElementById('nameEditar').value = data.persona[0].name;
                document.getElementById('apellidosEditar').value = data.persona[0].apellidos;
                document.getElementById('fechaEditar').value = data.persona[0].fechaNacimiento;
                document.getElementById('emailEditar').value = data.persona[0].email;
                document.getElementById('dniEditar').value = data.persona[0].dni;
                document.getElementById('idPersona').value = data.persona[0].idPersona;
                mostrarPopud("modal-editar");
            }
        }
    });
});

$(document).on('click','#aceptarEditar',function(e){
    limpiarModalEditar();
    var name = document.getElementsByName('nameEditar')[0].value;
    var email = document.getElementsByName('emailEditar')[0].value;
    var name = document.getElementsByName('nameEditar')[0].value;
    var apellidos = document.getElementsByName('apellidosEditar')[0].value;
    var dni = document.getElementsByName('dniEditar')[0].value;
    var fecha = document.getElementsByName('fechaEditar')[0].value;
    var password = document.getElementsByName('passwordEditar')[0].value;
    var sexo = document.getElementsByName('sexoEditar');
    var estado = document.getElementsByName('estadoEditar');
    var idPersona = document.getElementsByName('idPersonaEditar')[0].value;
    var token = document.getElementsByName('_token')[0].value;
    
    for(i=0; i<sexo.length; i++){
        if(sexo[i].checked){
            var tsexo=sexo[i].value;
        }
    }

    for(i=0; i<estado.length; i++){
        if(estado[i].checked){
            var testado=estado[i].value;
        }
    }

    var data = {"idPersona":idPersona,"id":idEliminar,"estado":testado,"password":password,"sexo":tsexo,"fecha":fecha,"email":email,"apellidos":apellidos,"dni":dni,"name":name,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/taxista/editar",
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
});