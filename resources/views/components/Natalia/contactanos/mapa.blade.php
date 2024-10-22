<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="\css\mapa.css">
<div id="map"></div> 
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-16.49405176491898, -68.13728546505341], 15); 

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([-16.49405176491898, -68.13728546505341]).addTo(map)
        .bindPopup('<b>Tienda Glow & Shine</b>')
        .openPopup();

    function onMapClick(e) {
        L.popup()
            .setLatLng(e.latlng)
            .setContent("Has hecho clic en " + e.latlng.toString())
            .openOn(map);
    }

    map.on('click', onMapClick);
</script>
