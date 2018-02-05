var map, miniMap;
var markers = new Array();

/**
 * Initialize Google Maps
 */
function initMap() {
    var mapOptions = {
        center: { lat: 63.1022601, lng: 21.5809185 },
        zoom: 8,
        streetViewControl: false
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
}

/**
 * Add marker into the map
 *
 * @param IMO - Ship IMO number
 * @param position - GPS coordinates
 * @param title - Info window title
 * @param markerInfoWindow - Marker's info window
 */
function addMarker(IMO, position, title, markerInfoWindow) {
    var marker = new google.maps.Marker({
        position: this.position,
        map: map,
        title: this.title
    });
    markers.push({ IMO: IMO, Marker: marker, markerInfoWindow: markerInfoWindow });

    google.maps.event.addListener(marker, 'click', function() {
        markerInfoWindow.open(map, marker);
    });
}

/**
 * Focus to the ship
 *
 * @param integer IMO - Ship IMO
 */
function focus_ship(IMO)
{
    var position = null;

    for (i in markers) {
        if (markers[i]['IMO'] == IMO) {
            position = markers[i]['Marker'].getPosition();
            google.maps.event.trigger(markers[i]['Marker'], 'click');
            break;
        }
    }

    if (position !== null) {
        map.setCenter(position);
    }
}