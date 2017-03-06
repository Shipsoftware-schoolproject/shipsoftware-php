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

function phpKutsu(kutsu)
{
    var status;
    var data

    var request = $.ajax({
                        async: false,
                        type: 'GET',
                        url: "sql.php?" + kutsu,
                    });

    request.done(function(response) {
        //alert("status: " + 200 + " data: " + response);
        status = 200;
        data = response;
    })

    request.fail(function(data) {
        status = data.status;
        this.data = data.response;
    });

    return { 'status': status, 'data': data };
}

function haeLaivat()
{
    var laivat = phpKutsu('haeLaivat=true');

    if (laivat['status'] != 200) {
        alert('Laivojen hakeminen ei onnistunut.');
    } else {
        laivat.data = JSON.parse(laivat.data);
        for (var key in laivat.data) {
            $(".laivatListBox").append("<option id=\"" + laivat.data[key]['ShipID'] + "\">" + laivat.data[key]['ShipName'] + "</option>");
        }
    }
}
