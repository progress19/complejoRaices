function initialize() {

    var raices = '<img src="images/logo.png" class="img-responsive logo-mapa" /><b>Complejo Raices</b><br><i class="icon_phone"></i> 2604-400282';
    var saint = '<img src="https://www.saintjosephweb.com.ar/wp-content/uploads/2022/12/logo.gif" class="img-responsive logo-mapa" /><b>Saint Joseph</b><br>Ruta 173 - Km 20 - San Rafael<br><i class="icon_phone"></i> 2604-673443';

     var locations = [ 
 
        [raices, -34.62983037694456, -68.37493911016706, 1, ''],  
        [saint, -34.81822716010604, -68.50386617090724, 2, ''],  

      ];

    window.map = new google.maps.Map(document.getElementById('google-map'), {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        navigationControl: false,
    });

    var infowindow = new google.maps.InfoWindow();
    var bounds = new google.maps.LatLngBounds();

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map,
          icon: locations[i][4],
        });

        bounds.extend(marker.position);

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    map.fitBounds(bounds);

    var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(11);
        google.maps.event.removeListener(listener);
    });


}

function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBBhh9bdv02x8XPknaSceyUsPFrz6ap4SE&sensor=false&' + 'callback=initialize';

    document.body.appendChild(script);
}

window.onload = loadScript;