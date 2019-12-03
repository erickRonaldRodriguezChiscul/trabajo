var pagina = 0;
var buscar = "";
var buscarP = "";
var idEliminar = "";


$(document).ready(function(){
    //$('#buscador').load('/inicio/contacto/miniTaxistaMostrar');
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
        url: "/inicio/tarifas/mostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data){
            pagina=0;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarTarifa");
            visible_elemento(elemento);
            visible_elemento(elemento1);
        }
    });
}

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});

function registrarContenedor(){
    $.ajax({
        url: "/inicio/tarifas/registrar",
        method: "GET",
        success: function(data) {
            pagina=1;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarTarifa");
            ocultar_elemento(elemento);
            ocultar_elemento(elemento1);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

$(document).on('keyup','#buscarP',function(e){
    buscarP = document.getElementById('buscarP').value;
    mostrarPersona(buscarP,1);
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

$("#contenedor").on('click','#registrarTarifa', function() {
    registrarContenedor();
});

function validaPorcentaje(id,e){
    var numero = document.getElementById(id).value.length;
    var valor = document.getElementById(id).value;
    var teclaPresionada = codigo = event.which || event.keyCode;
    if(numero==2){
        console.log(teclaPresionada);
        if(teclaPresionada != 8){
            if(valor>10){
                e.preventDefault();
            }
            if(teclaPresionada>48){
                e.preventDefault();
            }
        }
    }
    if(numero==3){
        if(teclaPresionada != 8){
            e.preventDefault();
        }
        
    }
}

$(document).on('keydown','#porcentajeTarifa',function(e){
    validaPorcentaje('porcentajeTarifa',e);
});

function addTarifa() {
    var nombreTarifa = document.getElementsByName('nombreTarifa')[0].value;
    var porcentajeTarifa = document.getElementsByName('porcentajeTarifa')[0].value;
    var token = document.getElementsByName('_token')[0].value;

    
    var data = {"nombreTarifa":nombreTarifa,"porcentajeTarifa":porcentajeTarifa,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/tarifas/add",
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

$("#contenedor").on('submit','#addTarifa', function(event) {
    event.preventDefault();
    addTarifa();
});

$(document).on('click','#limpiar',function(e){
    document.getElementsByName('nombreTarifa')[0].value="";
    document.getElementsByName('porcentajeTarifa')[0].value="";
});

$(document).on('click','#cancelar',function(e){
    document.getElementById('buscar').value="";
    mostrarLista("",1);
});

$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    page = $(this).attr('href').split('page=')[1];
    mostrarLista(buscar,page);
});

function limpiarModalEditar(){
    $("#nombreTarifaEditar").parent().removeClass("has-error");
    $("#porcentajeTarifaEditar").parent().removeClass("has-error");
    
    $(".nombreTarifaEditar").html("");
    $(".porcentajeTarifaEditar").html("");
    $(".mensaje-error").html("");
};

$(document).on('click','#modal-editar',function(e){
    limpiarModalEditar();
    idEliminar = this.getAttribute("attr-id");
    $.ajax({
        url: "/inicio/tarifas/recuperar",
        data: {"idEditar":idEliminar},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            if(data.tarifa.length)
            {
                document.getElementById('nombreTarifaEditar').value = data.tarifa[0].tipoTarifa;
                document.getElementById('porcentajeTarifaEditar').value = data.tarifa[0].porcentaje;
                document.getElementById('idTarifa').value = data.tarifa[0].idTarifa;
                var posE = data.tarifa[0].estado;
                var estado = document.getElementsByName('estadoEditar');
                if(posE == "S"){
                    estado[0].checked = true;
                }else{
                    estado[1].checked = true;
                }
                mostrarPopud("modal-editar");
            }
        }
    });

    $(document).on('click','#aceptarEditar',function(e){
        limpiarModalEditar();
        var nombreTarifa = document.getElementById('nombreTarifaEditar').value;
        var porcentajeTarifa = document.getElementById('porcentajeTarifaEditar').value;
        var idTarifa = document.getElementById('idTarifa').value;

        var token = document.getElementsByName('_token')[0].value;
        var estado = "";
        var testado = "";
        
        estado = document.getElementsByName('estadoEditar');
        for(i=0; i<estado.length; i++){
            if(estado[i].checked){
                testado=estado[i].value;
            }
        }

        var data = {"estado":testado,"idTarifa":idTarifa,"nombreTarifa":nombreTarifa,"porcentajeTarifa":porcentajeTarifa,"X-CSRF-TOKEN":token};
        
        $.ajax({
            url: "/inicio/tarifas/editar",
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
    mensaje.innerHTML = "Seguro que desea eliminar el registro de " + elemento[0].innerHTML;
    mostrarPopud(nombreModal);
});

$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/tarifas/eliminar",
        data: {"id":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                document.getElementById('tablaTarifa').rows[row].cells[2].innerText = 'Inactivo';
                $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                ocultarPopud($nombreModal);
            }
        }
    });
});