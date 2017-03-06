// Change the selector if needed
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();

    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });
}).resize(); // Trigger resize handler

function phpKutsu(kutsu, callback)
{
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            callback({ status: request.status, data: request.responseText });
        }
    };
    request.open('GET', 'sql.php?' + kutsu);
    request.send();
}

function haeLaivat(data = null)
{
    if (data === null) {
        phpKutsu('haeLaivat=true', haeLaivat);
        return;
    }

    if (data['status'] != 200) {
        alert(data);
    } else {
        var laivat = JSON.parse(data.data);

        for (var i in laivat) {
            $(".laivatListBox").append("<option id=\"" + laivat[i]['ShipID'] + "\">" + laivat[i]['ShipName'] + "</option>");
        }
    }
}
