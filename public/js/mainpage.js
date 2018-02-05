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

$(document).ready(function() {
    get_ships();
});
