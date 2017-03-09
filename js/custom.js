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

// Päivitä tab:n sisältö kun listalaatikon valinta muuttuu
$('#laivatListBox').change(function() {
    var currentTab = $('.nav-pills li.active').find('a').attr('href');

    // TODO: lisää puuttuvat funktiot
    if (currentTab == '#rahti') {
        haeRahti();
    }
});

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
            return false;
        } else {
            var id = listBox.options[listBox.selectedIndex].value;
        }

        phpKutsu('haeRahti=' + id, haeRahti);
        return true;
    }

    $('#rahtitiedot').empty();

    if (data['status'] != 200) {
        alert(data.data);
    } else {
        var rahti = JSON.parse(data.data);

        for (var i in rahti) {
            $('#rahtitiedot').append('<tr><th scope=row>' + rahti[i]['ContainerBarCode'] + '</th><td>' + rahti[i]['Content'] + '</td></tr>');
        }
    }

}

$('[data-toggle="tab"]').click(function(event) {
    var currentTab = $('.nav-pills li.active').find('a').attr('href');
    var targetTab = $(event.target).attr('href')

    if (currentTab == targetTab) {
        event.preventDefault();
        return false;
    }

    if (targetTab == '#rahti') {
        if (!haeRahti()) {
            alert('Valitse ensin laiva.');
            event.preventDefault();
            return false;
        }
    } else {
        alert('Tabiä "' + $(event.target).attr('href') + '" ei ole implementoitu');
    }
});