var markers=[];
var map,infoWindow,icon;
function crearMarcadores() {
    $.ajax({
        url: "/inicio/mapa/obtener",
        method: "get",
        dataType: "json",
        success: function(data) {
            var i=0;
            data.ubicacion.forEach(element => {
                var description = "<div> "+element.nombre+ " " + element.apellidos+" </div>";
                var myLatlng = new google.maps.LatLng(element.latitud, element.longitud);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    icon: icon,
                });
                markers[i] = marker;
                (function (marker) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        infoWindow.setContent(description);
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
                i++;
            });
        }
    });
}

function actualizarPosicion(){
    $.ajax({
        url: "/inicio/mapa/obtener",
        method: "get",
        dataType: "json",
        success: function(data) {
            var i=0;
            data.ubicacion.forEach(element => {
                var myLatlng = new google.maps.LatLng(element.latitud, element.longitud);
                markers[i].setPosition(myLatlng);;
                i++;
            });
        }
    });
}

window.onload = function () {
    var mapOptions = {
        center: new google.maps.LatLng("-6.7764721732986715", "-79.8338763506348"),
        zoom: 16,
    flat: true
    };
    icon = {
        url: "/img/53156.png", // url
        scaledSize: new google.maps.Size(50, 50), // scaled size
        origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
    };
    infoWindow = new google.maps.InfoWindow();
    map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
    crearMarcadores();
}

setInterval(actualizarPosicion, 1000);