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

function mostrarLista(query,page){
    $.ajax({
        url: "/inicio/vehiculo/mostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data){
            pagina=0;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarVehiculo");
            visible_elemento(elemento);
            visible_elemento(elemento1);
        }
    });
}

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

$(document).on('click','#aceptarEliminar',function(e){
    $.ajax({
        url: "/inicio/vehiculo/eliminar",
        data: {"idVehiculo":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                if(data.tipo == '2'){
                    document.getElementById('tablaVehiculo').deleteRow(row);
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }else{
                    document.getElementById('tablaVehiculo').rows[row].cells[7].innerText = 'Inactivo';
                    $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                    ocultarPopud($nombreModal);
                }
            }
        }
    });
});

function validaPlaca(id,e){
    var numero = document.getElementById(id).value.length;
    if(numero==6){
        e.preventDefault();
    }
}
$(document).on('keypress','#placaVehiculo',function(e){
    validaPlaca('placaVehiculo',e);
});

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

function registrarContenedor(){
    $.ajax({
        url: "/inicio/vehiculo/registrar",
        method: "GET",
        success: function(data) {
            pagina=1;
            $("#ingresarDatos").html(data);
            var elemento = document.getElementById("contenedorBuscar");
            var elemento1 = document.getElementById("registrarVehiculo");
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

$("#contenedor").on('click','#registrarVehiculo', function() {
    registrarContenedor();
});


function addContacto() {
    var marcaVehiculo = document.getElementsByName('marcaVehiculo')[0].value;
    var yearFabricacion = document.getElementsByName('yearFabricacion')[0].value;
    var placaVehiculo = document.getElementsByName('placaVehiculo')[0].value;
    var soat = document.getElementsByName('soat')[0].value;
    var tipoVehiculo = document.getElementsByName('tipoVehiculo')[0].value;
    var revisionTecnica = document.getElementsByName('revisionTecnica')[0].value;
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
    
    var data = {"idPersona":tpersona,"revisionTecnica":revisionTecnica,"tipoVehiculo":tipoVehiculo,"soat":soat,"marcaVehiculo":marcaVehiculo,"yearFabricacion":yearFabricacion,"placaVehiculo":placaVehiculo,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/vehiculo/add",
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

$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    page = $(this).attr('href').split('page=')[1];
    if(pagina==0){
        mostrarLista(buscar,page);
    }else{
        mostrarPersona(buscar,page);
    }
});

$(document).on('click','#limpiar',function(e){
    document.getElementsByName('marcaVehiculo')[0].value="";
    document.getElementsByName('yearFabricacion')[0].value="";
    document.getElementsByName('placaVehiculo')[0].value="";
    document.getElementsByName('soat')[0].value="";
    document.getElementsByName('revisionTecnica')[0].value="";
});

function limpiarModalEditar(){
    $("#marcaVehiculoEditar").parent().removeClass("has-error");
    $("#yearFabricacionEditar").parent().removeClass("has-error");
    $("#placaVehiculoEditar").parent().removeClass("has-error ");
    $("#soatEditar").parent().removeClass("has-error ");
    $("#revisionTecnicaEditar").parent().removeClass("has-error ");
    $(".marcaVehiculoEditar").html("");
    $(".yearFabricacionEditar").html("");
    $(".placaVehiculoEditar").html("");
    $(".soatEditar").html("");
    $(".revisionTecnicaEditar").html("");
    $(".mensaje-error").html("");
};

$(document).on('click','#modal-editar',function(e){
    limpiarModalEditar();
    idEliminar = this.getAttribute("attr-id");
    $.ajax({
        url: "/inicio/vehiculo/recuperar",
        data: {"idEditar":idEliminar},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            if(data.vehiculo.length)
            {
                if($(".js-example-basic-single").length){
                    var posE = data.vehiculo[0].estado;
                    var estado = document.getElementsByName('estadoEditar');
                    if(posE == "S"){
                        estado[0].checked = true;
                    }else{
                        estado[1].checked = true;
                    }
                }
                document.getElementById('marcaVehiculoEditar').value = data.vehiculo[0].marcaVehiculo;
                document.getElementById('yearFabricacionEditar').value = data.vehiculo[0].yearFabricacion;
                document.getElementById('placaVehiculoEditar').value = data.vehiculo[0].placaVehiculo;
                document.getElementById('soatEditar').value = data.vehiculo[0].soat;
                document.getElementById('tipoVehiculoEditar').value = data.vehiculo[0].tipoVehiculo;
                document.getElementById('revisionTecnicaEditar').value = data.vehiculo[0].revisionTecnica;
                document.getElementById('idVehiculo').value = data.vehiculo[0].idVehiculo;
                $('.js-example-basic-single').val(data.vehiculo[0].idPersona).trigger('change.select2');
                mostrarPopud("modal-editar");
            }
        }
    });
});

$(document).on('click','#aceptarEditar',function(e){
    limpiarModalEditar();
    var marcaVehiculo = document.getElementsByName('marcaVehiculoEditar')[0].value;
    var yearFabricacion = document.getElementsByName('yearFabricacionEditar')[0].value;
    var placaVehiculo = document.getElementsByName('placaVehiculoEditar')[0].value;
    var soat = document.getElementsByName('soatEditar')[0].value;
    var tipoVehiculo = document.getElementsByName('tipoVehiculoEditar')[0].value;
    var revisionTecnica = document.getElementsByName('revisionTecnicaEditar')[0].value;
    var idVehiculo = document.getElementById('idVehiculo').value;
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
    var data = {'estado':testado,"idVehiculo":idVehiculo,"idPersona":idPersona,"revisionTecnica":revisionTecnica,"tipoVehiculo":tipoVehiculo,"soat":soat,"marcaVehiculo":marcaVehiculo,"yearFabricacion":yearFabricacion,"placaVehiculo":placaVehiculo,"X-CSRF-TOKEN":token};
    
    $.ajax({
        url: "/inicio/vehiculo/editar",
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