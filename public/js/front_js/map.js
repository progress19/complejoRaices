function initialize() {
    var raices = '<img src="images/logo.png" class="img-responsive logo-mapa" /><b>Complejo Raices</b><br><i class="icon_phone"></i> 2604-400282';
    var saint = '<img src="https://www.saintjosephweb.com.ar/images/logo.png" class="img-responsive logo-mapa" /><b>Saint Joseph</b><br>Ruta 173 - Km 20 - San Rafael<br><i class="icon_phone"></i> 2604-673443';

    var locations = [ 
        [raices, -34.62983037694456, -68.37493911016706, 1, ''],  
        [saint, -34.81822716010604, -68.50386617090724, 2, ''],  
    ];

    // Inicializar el mapa de Leaflet
    window.map = L.map('google-map', {
        scrollWheelZoom: false,
        zoomControl: true
    });

    // Agregar capa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Crear un grupo para los bounds
    var group = new L.featureGroup();

    // Agregar marcadores
    for (var i = 0; i < locations.length; i++) {
        var marker = L.marker([locations[i][1], locations[i][2]])
            .addTo(map)
            .bindPopup(locations[i][0]);
        
        // Agregar al grupo para calcular bounds
        group.addLayer(marker);
    }

    // Ajustar la vista para mostrar todos los marcadores
    map.fitBounds(group.getBounds());

    // Establecer zoom específico después de ajustar bounds
    setTimeout(function() {
        map.setZoom(11);
    }, 100);
}

function loadScript() {
    // Cargar CSS de Leaflet
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
    document.head.appendChild(link);

    // Cargar JS de Leaflet
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    script.onload = function() {
        initialize();
    };
    document.body.appendChild(script);
}

document.addEventListener('DOMContentLoaded', function() {
    loadScript();
});
