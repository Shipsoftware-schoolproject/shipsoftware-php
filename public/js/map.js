let map;
let markers = Array();

/**
 * Initialize Google Maps and add markers
 */
function initMap() {
    let mapOptions = {
        center: { lat: 63.1022601, lng: 21.5809185 },
        zoom: 8,
        streetViewControl: false
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    $('#lstShips option').each(function() {
        let marker = new google.maps.Marker({
            position: new google.maps.LatLng($(this).data('lat'), $(this).data('lng')),
            map: map,
            title: this.value
        });

        let infoWin = new google.maps.InfoWindow({
            content: this.text + '<br>N: ' + $(this).data('lat') +
                        '<br>E: ' + $(this).data('lng') +
                        '<br>Update Time: ' + $(this).data('updated')
        });

        google.maps.event.addListener(marker, 'click', function() {
            infoWin.open(map, marker);
        });

        markers.push({ IMO: this.value, Marker: marker, markerInfoWindow: infoWin });
    })
}

/**
 * Focus to ship marker
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
