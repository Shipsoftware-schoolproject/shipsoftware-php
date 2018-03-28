/**
 * Selection changed listener for ships listbox
 */
$("#lstShips").change(function() {
    var lstShips = document.getElementById('lstShips');
    if (lstShips.options[lstShips.selectedIndex]) {
        focus_ship(lstShips.options[lstShips.selectedIndex].value);
    }
});

/**
 * Search a ship by it's name
 *
 * @param data - JSON response from API
 * @param name - Ship's name to search
 */
function search_ships(data, name)
{
    if (data === null) {
        api_get('ship/name/' + name, search_ships);
        return;
    }

    let lstShips = $('#lstShips');
    lstShips.find('option').remove();

    if (data['status'] !== 200) {
        if (data.data === '') {
            lstShips.append('<option>Server error</option>');
        } else {
            lstShips.append('<option>' + data.data + '</option>');
        }
    } else {
        let response = JSON.parse(data.data);
        let ships = response['ships'];

        for (let i in ships) {
            lstShips.append('<option value="' + ships[i]['IMO'] + '">'
                + ships[i]['ShipName'] + '</option>');
        }
    }
}

/**
 * Listen text change in ship search field
 */
$('#shipSearch').on('input', function() {
    let text = $('#shipSearch').val().trim();
    if (text.length >= 2) {
        search_ships(null, text);
    } else if (text.length === 0) {
        search_ships(null, '');
    }
});

$('#lstCompanies').change(function () {
    // TODO: Implementation..
});

/**
 * Redirect to ship information page
 */
function shipDetails() {
    var lstShips = document.getElementById('lstShips');

    if (lstShips.options[lstShips.selectedIndex]) {
        window.location.href = 'ship/'
            + lstShips.options[lstShips.selectedIndex].value;
    } else {
        alert($('#lstShip_errormsg').val());
    }
}

$(document).ready(function() {
    get_ships();
});
