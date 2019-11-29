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

function mostrarLista(query,page){
    $.ajax({
        url: "/inicio/servicio/mostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data){
            pagina=0;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarServicio");
            visible_elemento(elemento);
            visible_elemento(elemento1);
        }
    });
}

$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    page = $(this).attr('href').split('page=')[1];
    mostrarLista(buscar,page);
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});

$(document).on('click','#cancelar',function(e){
    document.getElementById('buscar').value="";
    mostrarLista("",1);
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

$(document).on('click','#modal-eliminar',function(e){
    nombreModal = this.dataset.target;
    elemento = this.parentElement.parentElement.getElementsByTagName("td");
    idEliminar = this.getAttribute("attr-id");
    row= this.parentNode.parentNode.rowIndex;
    mensaje = document.getElementsByClassName("nombreEliminar")[0];
    mensaje.innerHTML = "Seguro que desea eliminar el servicio de " + elemento[0].innerHTML;
    mostrarPopud(nombreModal);
});


$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/servicio/eliminar",
        data: {"id":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                if(data.tipo == '2'){
                    document.getElementById('tablaServicio').deleteRow(row);
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }else{
                    document.getElementById('tablaServicio').rows[row].cells[4].innerText = 'Inactivo';
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }
            }
        }
    });
});

function registrarContenedor(){
    $.ajax({
        url: "/inicio/servicio/registrar",
        method: "GET",
        success: function(data) {
            pagina=1;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarServicio");
            ocultar_elemento(elemento);
            ocultar_elemento(elemento1);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

$("#contenedor").on('click','#registrarServicio', function() {
    registrarContenedor();
});

$(document).on('click','#limpiar',function(e){
    $('#nombreServicio').val("");
    $('#importeServicio').val("");
});

function addServicio() {
    var nombreServicio = document.getElementsByName('nombreServicio')[0].value;
    var importeServicio = document.getElementsByName('importeServicio')[0].value;
    var token = document.getElementsByName('_token')[0].value;
    
    var data = {"importeServicio":importeServicio,"nombreServicio":nombreServicio,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/servicio/add",
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

$("#contenedor").on('submit','#addServicio', function(event) {
    event.preventDefault();
    addServicio();
});

//validar un float
function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    } 
}

function limpiarModalEditar(){
    $("#nombreServicio").parent().removeClass("has-error");
    $("#importeServicio").parent().removeClass("has-error");
    $(".nombreServicio").html("");
    $(".importeServicio").html("");
};


$(document).on('click','#modal-editar',function(e){
    limpiarModalEditar();
    idEliminar = this.getAttribute("attr-id");
    $.ajax({
        url: "/inicio/servicio/recuperar",
        data: {"idEditar":idEliminar},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            if(data.servicio.length)
            {
                var posE = data.servicio[0].estado;
                var estado = document.getElementsByName('estadoEditar');
                if(posE == "S"){
                    estado[0].checked = true;
                }else{
                    estado[1].checked = true;
                }

                document.getElementById('nombreServicioEditar').value = data.servicio[0].nombreServicio;
                document.getElementById('importeServicioEditar').value = data.servicio[0].importe;
                document.getElementById('idServicio').value = data.servicio[0].idServicio;
                mostrarPopud("modal-editar");
            }
        }
    });
});

$(document).on('click','#aceptarEditar',function(e){
    limpiarModalEditar();
    var nombreServicioEditar = document.getElementById('nombreServicioEditar').value;
    var importeServicioEditar = document.getElementById('importeServicioEditar').value;
    var token = document.getElementsByName('_token')[0].value;
    var idServicio = document.getElementById('idServicio').value;
    var estado = document.getElementsByName('estadoEditar');
    for(i=0; i<estado.length; i++){
        if(estado[i].checked){
            var testado=estado[i].value;
        }
    }

    var data = {"idServicio":idServicio,"estado":testado,"nombreServicio":nombreServicioEditar,"importeServicio":importeServicioEditar,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/servicio/editar",
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
