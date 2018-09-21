let map;
let markers = Array();

/**
 * Initialize map and add markers
 *
 * @param lat
 * @param lng
 * @param zoom
 * @return void
 */
function initMap(lat = 63.260144, lng = 21.118005, zoom = 9) {
    map = L.map('map').setView([lat, lng], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        maxZoom: 18,
    }).addTo(map);
}

/**
 * Add marker to the map
 *
 * @param shipName
 * @param imo
 * @param lat
 * @param lng
 * @param updated
 * @param addTooltip
 * @param openPopup
 * @return void
 */
function addMarker(shipName, imo, lat, lng, updated, addTooltip = true,
                   openPopup = false)
{
    let marker = L.marker([lat, lng]);

    if (addTooltip === true) {
        marker.bindTooltip(shipName);
    }

    marker.bindPopup('<b>' + shipName + '</b><br>' +
        'N: ' + lat + '<br>' + ' E: ' + lng + '<br>' +
        'Updated Time: ' + updated);

    marker.addTo(map);
    markers[imo] = marker;

    if (open === true) {
        marker.openPopup(marker.getLatLng());
    }
}

/**
 * Draw polyline to map from LatLng points
 *
 * @param latlngs - Array(lat, lng)
 * @return void
 */
function addPolyline(latlngs) {
    L.polyline(latlngs, {color: 'red'}).addTo(map);
}

/**
 * Focus to ship marker
 *
 * @param IMO - Ship IMO
 * @return void
 */
function focusShip(IMO)
{
    if (markers[IMO]) {
        let pos = markers[IMO].getLatLng();

        map.flyTo(pos, 9.5, {"animate": true, "pan": { "duration": 5.5 }});
        markers[IMO].openPopup();
    }
}
