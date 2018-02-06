/**
 * Selection changed listener for ships listbox
 */
$("#lstShips").change(function() {
    var lstShips = document.getElementById('lstShips');
    if (lstShips.options[lstShips.selectedIndex]) {
        focus_ship(lstShips.options[lstShips.selectedIndex].value);
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
