var map;
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
 * @param lat - Latitude
 * @param lng Longitude
 * @param title - Info window title
 */
function addMarker(IMO, lat, lng, title) {
    let deferred = new $.Deferred();
    let marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: map,
        title: this.title
    });
    let infoWin = new google.maps.InfoWindow({
        content: title + '<br>N: ' + lat + '<br>E: ' + lng
    });
    markers.push({ IMO: IMO, Marker: marker, markerInfoWindow: infoWin });

    google.maps.event.addListener(marker, 'click', function() {
        infoWin.open(map, marker);
    });

    deferred.resolve();
    return deferred.promise();
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