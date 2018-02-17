/**
 * Get ships into listbox and add them into map
 *
 * @param mixed data - Use null when calling this function
 */
function get_ships(data = null)
{
    if (data === null) {
        api_get('ship/name/all', get_ships);
        return;
    }

    if (data['status'] != 200) {
        $('#lstShips').attr('disabled', true);
        if (data.data == '') {
            $('#lstShips').append('<option>Server error</option>');
        } else {
            $('#lstShips').append('<option>' + data.data + '</option>');
        }
    } else {
        var response = JSON.parse(data.data);
        var ships = response['ships'];

        for (var i in ships) {
            $("#lstShips").append('<option value="'
                + ships[i]['IMO'] + '">'
                + ships[i]['ShipName']
                + '</option>');

            if (ships[i]['Lat'] !== null) {
                addMarker(ships[i]['IMO'], ships[i]['Lat'], ships[i]['Lng'],
                    ships[i]['ShipName']);
            }
        }

        // Select first item in listbox
        $('#lstShips').val($('#lstShips option:first').val()).trigger('change');
    }
}
