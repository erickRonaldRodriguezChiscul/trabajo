var buscar = "";
var idEliminar = "";
var d = new Date();
var month = d.getMonth()+1;
var day = d.getDate()+1;
var inicio =  d.getFullYear() + '/' +
(month<10 ? '0' : '') + month + '/' +
(day<10 ? '0' : '') + day;
var fin = d.getFullYear() + '/' +
(month<10 ? '0' : '') + month + '/' +
(day<10 ? '0' : '') + day;
var inicioEditar =  d.getFullYear() + '/' +
(month<10 ? '0' : '') + month + '/' +
(day<10 ? '0' : '') + day;
var finEditar = d.getFullYear() + '/' +
(month<10 ? '0' : '') + month + '/' +
(day<10 ? '0' : '') + day;


$(document).ready(function(){
    $('#buscador').load('/inicio/programacion/mostrarPersona');
    $('#buscadorServicio').load('/inicio/programacion/mostrarServicio');
    $('#buscadorEditar').load('/inicio/programacion/mostrarPersonaPopads');
    $('#buscadorEditar').load('/inicio/programacion/mostrarPersonaPopads');
    $('#buscadorServicioEditar').load('/inicio/programacion/mostrarServicioPopads');
    mostrarProgramacion("")
});

$(document).on('click','#limpiar',function(e){
    $('#daterange').data('daterangepicker').setStartDate((day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' +d.getFullYear());
    $('#daterange').data('daterangepicker').setEndDate((day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month + '/' + d.getFullYear());
    $('.js-example-basic-multiple').val(null).trigger('change');
});

$(document).on('click','#aceptar',function(e){
    var ban = false;
    var servicio = $('.servicios').val();
    var multiPersona = $('.js-example-basic-multiple').val();
    var token = document.getElementsByName('_token')[0].value;

    var data = {"fin":fin,"inicio":inicio,"servicio":servicio,"multiPersona":multiPersona,"X-CSRF-TOKEN":token};

    $.ajax({
        url: "/inicio/programacion/add",
        method: "POST",
        data: data,
        success: function(data) {
            console.log(data);
        },
        error: function(error) {
            $.each(error.responseJSON.errors,function(name,value){
                document.getElementsByClassName(name)[0].innerHTML='<span class="help-block" role="alert">'+
                        '<strong>'+ value[0]+'</strong></span>';
                document.getElementById(name).parentElement.className += ' has-error ';
            });
        }
    }).fail( function( jqXHR, textStatus, errorThrown ) {
        var mensaje = "";
        
        if(jqXHR.status==422){
            mensaje += "<p>Debes ingresar todos los datos.</p>";
        }else if (jqXHR.status === 0) {
            mensaje += '<p>Sin Conexion: Verifique la red.</p>';
        }else if (jqXHR.status == 500) {
            mensaje += '<p>Error al registrar los datos.</p>';    
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

$('#daterange').daterangepicker({
    opens: 'left',
    "locale":{
        "format":"DD/MM/YYYY",
        "applyLabel": "Aplicar",
        "canceLabel": "Cancelar",
        "daysOfWeek":[
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames":[
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay":1
    }
}, function(start, end, label) {
    alert("chai");
    inicio = start.format('YYYY-MM-DD');
    fin = end.format('YYYY-MM-DD');
});

$('#daterangeEditar').daterangepicker({
    opens: 'left',
    "locale":{
        "format":"DD/MM/YYYY",
        "applyLabel": "Aplicar",
        "canceLabel": "Cancelar",
        "daysOfWeek":[
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames":[
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay":1
    }
}, function(start, end, label) {
    alert("Hola");
    inicioEditar = start.format('YYYY-MM-DD');
    finEditar = end.format('YYYY-MM-DD');
});


function mostrarProgramacion(query,page){
    $.ajax({
        url: "/inicio/programacion/mostrar",
        data: {"query":query,"page":page},
        method: "GET",
        success: function(data){
            $("#mostrarDatos").html(data)
        }
    });
}

$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    page = $(this).attr('href').split('page=')[1];
    mostrarProgramacion(buscar,page);
});

$(document).on('keyup','#buscar',function(e){
    buscar = document.getElementById('buscar').value;
    mostrarProgramacion(buscar,1);
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
        url: "/inicio/programacion/eliminar",
        data: {"idProgramacion":idEliminar},
        method: "POST",
        dataType: "json",
        success: function(data) {
            if(data.estado == 'ok'){
                document.getElementById('tablaProgramacion').rows[row].cells[3].innerText = 'Inactivo';
                $nombreModal = document.getElementById('aceptarEliminar').dataset.dismiss;
                ocultarPopud($nombreModal);
            }
        }
    });
});

$(document).on('click','#modal-editar',function(e){
    /*
    Values.push("12");
    Values.push("13");
    Values.push("8");
    mostrarPopud("modal-editar");*/
    /*limpiarModalEditar();*/
    $('.editar-multiple').val("").trigger('change.select2');
    idEliminar = this.getAttribute("attr-id");
    $.ajax({
        url: "/inicio/programacion/recuperar",
        data: {"idEditar":idEliminar},
        method: "POST",
        dataType: 'json',
        success: function(data) {
            var Values = new Array();
            var posE = "";
            data.programacion.forEach(element => {
                inicioEditar = element.fechaInicio;
                finEditar = element.fechaFinal;
                Values.push(element.IdPersona);
                idServicio = element.idServicio;
                posE = element.estado;
            });

            $('#daterangeEditar').daterangepicker({
                "startDate": moment(inicioEditar),
                "endDate":  moment(finEditar),
            }, function(start, end, label) {
                inicioEditar = start.format('YYYY-MM-DD');
                finEditar = end.format('YYYY-MM-DD');
            });
            $('.serviciosPopads').val(idServicio).trigger('change.select2');
            $('.editar-multiple').val(Values).trigger('change.select2');
            var estado = document.getElementsByName('estadoEditar');
            if(posE == "S"){
                estado[0].checked = true;
            }else{
                estado[1].checked = true;
            }
            mostrarPopud("modal-editar");
        }
    });
});

function formato(texto){
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}

$(document).on('click','#aceptarEditar',function(e){
    var ban = false;
    var servicio = $('.serviciosPopads').val();
    var multiPersona = $('.editar-multiple').val();
    var token = document.getElementsByName('_token')[0].value;

    var data = {"fin":finEditar,
    "inicio":inicioEditar,
    "servicio":servicio,
    "multiPersona":multiPersona,
    "idProgramacion":idEliminar,
    "X-CSRF-TOKEN":token};
console.log(inicioEditar);
    $.ajax({
        url: "/inicio/programacion/editar",
        method: "POST",
        data: data,
        success: function(data) {
            mostrarProgramacion("",1);
            ocultarPopud("modal-editar");
        },  
        error: function(error) {
            $.each(error.responseJSON.errors,function(name,value){
                document.getElementsByClassName(name)[0].innerHTML='<span class="help-block" role="alert">'+
                        '<strong>'+ value[0]+'</strong></span>';
                document.getElementById(name).parentElement.className += ' has-error ';
            });
        }
    }).fail( function( jqXHR, textStatus, errorThrown ) {
        var mensaje = "";
        
        if(jqXHR.status==422){
            mensaje += "<p>Debes ingresar todos los datos.</p>";
        }else if (jqXHR.status === 0) {
            mensaje += '<p>Sin Conexion: Verifique la red.</p>';
        }else if (jqXHR.status == 500) {
            mensaje += '<p>Error al registrar los datos.</p>';    
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