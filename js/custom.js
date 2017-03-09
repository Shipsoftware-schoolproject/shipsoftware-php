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
    //if (window.XMLHttpRequest) {
        var request = new XMLHttpRequest();
    //} else {
        //var request = new ActiveXObject("Microsoft.XMLHTTP");
    //}
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
        alert(data.data);
    } else {
        var laivat = JSON.parse(data.data);

        for (var i in laivat) {
            $("#laivatListBox").append("<option value=\"" + laivat[i]['ShipID'] + "\">" + laivat[i]['ShipName'] + "</option>");
        }
    }
}

function haeRahti(data = null)
{
    if (data === null) {
        var listBox = document.getElementById('laivatListBox');
        if (!listBox.options[listBox.selectedIndex]) {
            alert('Valitse ensin laiva.');
            //return; //e.preventDefault();
        } else {
            var id = listBox.options[listBox.selectedIndex].value;
        }
        
        phpKutsu('haeRahti=' + id, haeRahti);
        return;
    }

    if (data['status'] != 200) {
        alert(data.data);
    } else {
        var rahti = JSON.parse(data.data);

        for (var i in rahti) {
            $("#rahti").append('<tr><th scope=row>' + rahti[i]['ContainerBarCode'] + '</th><td>' + rahti[i]['Content'] + '</td></tr>');
        }
    }

}

$('[data-toggle="tab"]').click(function(event) {
    if ($(event.target).attr('href') == '#rahti') {
        haeRahti();
    } else {
        alert('Tabiä "' + $(event.target).attr('href') + '" ei ole implementoitu');
    }
});