var pagina = 0;
var buscar = "";
var buscarP = "";
var idEliminar = "";
var idSoatEditar ="";

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

function mostrarSoat(palabra,page,idEliminar){
    $.ajax({
        url: "/inicio/vehiculo/recuperarSoat",
        data: {"idEditar":idEliminar,"page":page,"palabra":palabra},
        method: "POST",
        success: function(data) {
                $(".idSoat").html(data);
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
    mostrarSoat("",1,idEliminar)
});

function limpiar() {
    $("#entidadSoat").val("");
    $("#fechaVencimientoSoat").val("");
    $("#subirSoat").val("");

    $("#entidadSoat").parent().removeClass("has-error");
    $("#fechaVencimientoSoat").parent().removeClass("has-error");
    $("#subirSoat").parent().removeClass("has-error");

    $(".entidadSoat").html("");
    $(".fechaVencimientoSoat").html("");
    $(".subirSoat").html("");
    
    $(".mensaje-error").html("");
    $("#aceptarEditar").attr("disabled","disabled");
    $("#aceptarRegistrar").removeAttr("disabled");
    document.getElementById("mostrarFoto").src="/imagen/no_disponible.png";    
}

function addSoat(){
    var entidadSoat = document.getElementsByName('entidadSoat')[0].value;
    var subirSoat = $('#subirSoat');
    var fechaVencimientoSoat = document.getElementsByName('fechaVencimientoSoat')[0].value;
    var idVehiculo = idEliminar;

    var token = document.getElementsByName('_token')[0].value;

    var formData = new FormData();
    formData.append('entidadSoat',entidadSoat);
    formData.append('subirSoat',subirSoat[0].files[0]);
    formData.append('fechaVencimientoSoat',fechaVencimientoSoat);
    formData.append('idVehiculo',idVehiculo);
    formData.append('X-CSRF-TOKEN',token);

    $.ajax({
        url: "/inicio/vehiculo/addSoat",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            mostrarSoat("",1,idEliminar);
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

$(document).on('click','#aceptarlimpiar',function(e) {
    limpiar();
});

$(document).on('click','#editarSoat',function(e) {
    var entidad=$(this).parent("td").parent("tr").children(".entidad").html();
    var fecha=$(this).parent("td").parent("tr").children(".fecha").html();
    var urlImagen = $(this).attr("attr-src");
    idSoatEditar = $(this).attr("attr-id");

    $("#entidadSoat").val(entidad);
    $("#fechaVencimientoSoat").val(fecha);
    document.getElementById("mostrarFoto").src="/imagen/vehiculos/"+urlImagen;
    $("#aceptarRegistrar").attr("disabled","disabled");
    $("#aceptarEditar").removeAttr("disabled");
});

$(document).on('click','#aceptarRegistrar',function(e) {
    addSoat();
});

$(document).on('click','#aceptarEditar',function(e){
    var entidadSoat = document.getElementsByName('entidadSoat')[0].value;
    var subirSoat = $('#subirSoat');
    var fechaVencimientoSoat = document.getElementsByName('fechaVencimientoSoat')[0].value;
    //var idRevisionEditar = idRevisionEditar;

    var token = document.getElementsByName('_token')[0].value;

    var formData = new FormData();
    formData.append('entidadSoat',entidadSoat);
    formData.append('subirSoat',subirSoat[0].files[0]);
    formData.append('fechaVencimientoSoat',fechaVencimientoSoat);
    formData.append('idSoat',idSoatEditar);
    formData.append('idVehiculo',idEliminar);
    formData.append('X-CSRF-TOKEN',token);

    $.ajax({
        url: "/inicio/vehiculo/editarSoat",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            mostrarSoat("",1,idEliminar);
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
$("#subirSoat").change(function() {
    foto(this);
});