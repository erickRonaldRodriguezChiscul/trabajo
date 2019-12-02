var pagina = 0;
var buscar = "";
var buscarP = "";
var idEliminar = "";
var idRevisionEditar ="";

$(document).ready(function(){
    //$('#buscador').load('/inicio/contacto/miniTaxistaMostrar');
    mostrarLista("",1);
});

function ocultar_elemento(elemento){
    elemento.style.display = 'none';
    pagina=0;
}

function visible_elemento(elemento){
    elemento.style.display = '';
    pagina=1;
}

function mostrarLista(query,page){
    $.ajax({
        url: "/inicio/vehiculo/mostrarRevision",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data){
            pagina=0;
            $("#ingresarDatos").html(data);
        }
    });
}

function mostrarRevision(palabra,page,idEliminar){
    $.ajax({
        url: "/inicio/vehiculo/recuperarRevision",
        data: {"idEditar":idEliminar,"page":page,"palabra":palabra},
        method: "POST",
        success: function(data) {
                $(".idRevision").html(data);
                mostrarPopud("modal-historial");
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

$(document).on('click','#modal-historial',function(e){
    limpiar();
    idEliminar = this.getAttribute("attr-id");
    mostrarRevision("",1,idEliminar)
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarLista(buscar,1);
});

$(document).on('keyup','#buscarP',function(e){
    buscarP = document.getElementById('buscarP').value;
    mostrarRevision(buscarP,1,idEliminar);
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

function limpiar() {
    $("#entidadRevision").val("");
    $("#fechaVencimientoRevision").val("");
    $("#observaciones").val("");
    $("#subirRevision").val("");

    $("#entidadRevision").parent().removeClass("has-error");
    $("#fechaVencimientoRevision").parent().removeClass("has-error");
    $("#observaciones").parent().removeClass("has-error");
    $("#subirRevision").parent().removeClass("has-error");

    $(".entidadRevision").html("");
    $(".fechaVencimientoRevision").html("");
    $(".observaciones").html("");
    $(".subirRevision").html("");
    
    $(".mensaje-error").html("");
    $("#aceptarEditar").attr("disabled","disabled");
    $("#aceptarRegistrar").removeAttr("disabled");
    document.getElementById("mostrarFoto").src="/imagen/no_disponible.png";    
}

$(document).on('click','#aceptarlimpiar',function(e){
    limpiar();
});

function addRevision() {
    var entidadRevision = document.getElementsByName('entidadRevision')[0].value;
    var subirRevision = $('#subirRevision');
    var fechaVencimientoRevision = document.getElementsByName('fechaVencimientoRevision')[0].value;
    var observaciones = document.getElementsByName('observaciones')[0].value;
    var idVehiculo = idEliminar;

    var token = document.getElementsByName('_token')[0].value;

    var formData = new FormData();
    formData.append('entidadRevision',entidadRevision);
    formData.append('subirRevision',subirRevision[0].files[0]);
    formData.append('fechaVencimientoRevision',fechaVencimientoRevision);
    formData.append('observaciones',observaciones);
    formData.append('idVehiculo',idVehiculo);
    formData.append('X-CSRF-TOKEN',token);

    $.ajax({
        url: "/inicio/vehiculo/addRevision",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            mostrarRevision("",1,idEliminar);
            limpiar();
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
            mensaje += '<p>No se pudo registrar correctamente</p>';    
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

$(document).on('click','#aceptarRegistrar',function(e) {
    addRevision();
});

$(document).on('click','#editarRevision',function(e) {
    var entidad=$(this).parent("td").parent("tr").children(".entidad").html();
    var fecha=$(this).parent("td").parent("tr").children(".fecha").html();
    var observacion=$(this).parent("td").parent("tr").children(".observacion").html();
    var urlImagen = $(this).attr("attr-src");
    idRevisionEditar = $(this).attr("attr-id");

    $("#entidadRevision").val(entidad);
    $("#fechaVencimientoRevision").val(fecha);
    $("#observaciones").val(observacion);
    document.getElementById("mostrarFoto").src="/imagen/vehiculos/"+urlImagen;
    $("#aceptarRegistrar").attr("disabled","disabled");
    $("#aceptarEditar").removeAttr("disabled");
});

$(document).on('click','#aceptarEditar',function(e){
    var entidadRevision = document.getElementsByName('entidadRevision')[0].value;
    var subirRevision = $('#subirRevision');
    var fechaVencimientoRevision = document.getElementsByName('fechaVencimientoRevision')[0].value;
    var observaciones = document.getElementsByName('observaciones')[0].value;
    //var idRevisionEditar = idRevisionEditar;

    var token = document.getElementsByName('_token')[0].value;

    var formData = new FormData();
    formData.append('entidadRevision',entidadRevision);
    formData.append('subirRevision',subirRevision[0].files[0]);
    formData.append('fechaVencimientoRevision',fechaVencimientoRevision);
    formData.append('observaciones',observaciones);
    formData.append('idRevision',idRevisionEditar);
    formData.append('idVehiculo',idEliminar);
    formData.append('X-CSRF-TOKEN',token);

    $.ajax({
        url: "/inicio/vehiculo/editarRevision",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            mostrarRevision("",1,idEliminar);
            limpiar();
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
            mensaje += '<p>No se pudo registrar correctamente</p>';    
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

function foto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
        // Asignamos el atributo src a la tag de imagen
        $('#mostrarFoto').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
// El listener va asignado al input
$("#subirRevision").change(function() {
    foto(this);
});