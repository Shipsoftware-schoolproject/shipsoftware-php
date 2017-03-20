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

// Keskitä kartta laivan Markkeriin kun laiva valitaan listalaatikosta
function keskitaKartta(ShipID)
{
    var sijainti = null;

    for (i in markers) {
        if (markers[i]['ShipID'] == ShipID) {
            sijainti = markers[i]['Marker'].getPosition();
            google.maps.event.trigger(markers[i]['Marker'], 'click');
            break;
        }
    }

    if (sijainti !== null) {
        map.setCenter(sijainti);
    }
}

// Päivitä tab:n sisältö kun listalaatikon valinta muuttuu
$('#laivatListBox').change(function() {
    var currentTab = $('.nav-pills li.active').find('a').attr('href');

    // TODO: lisää puuttuvat funktiot
    if (currentTab == '#rahti') {
        haeRahti();
    } else if (currentTab == '#kartta') {
        var listBox = document.getElementById('laivatListBox');
        if (!listBox.options[listBox.selectedIndex]) {
            return false;
        } else {
            keskitaKartta(listBox.options[listBox.selectedIndex].value);
        }
    }
    else if (currentTab == '#miehistö'){
        haeMiehisto();
    }
});

function haeLaivat(data = null)
{
    if (data === null) {
        phpKutsu('haeLaivat=true', haeLaivat);
        return;
    }

    if (data['status'] != 200) {
        $('#laivatListBox').attr('disabled', true);
        $('#laivatListBox').append('<option>' + data.data + '</option>');
    } else {
        var laivat = JSON.parse(data.data);

        for (var i in laivat) {
            $("#laivatListBox").append('<option value="' + laivat[i]['ShipID'] + '">' + laivat[i]['ShipName'] + '</option>');
            if (laivat[i]['North'] != null) {
                sijainti = new google.maps.LatLng(laivat[i]['North'], laivat[i]['East']);
                infoIkkuna = new google.maps.InfoWindow({ content: laivat[i]['ShipName'] + '<br>N: ' + laivat[i]['North'] + '<br>E: ' + laivat[i]['East'] });
                addMarker(laivat[i]['ShipID'], sijainti, laivat[i]['ShipName'], infoIkkuna);
            }
        }

        // Valitse listalaatikon eka itemi
        $('#laivatListBox').val($('#laivatListBox option:first').val());
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
        $('#rahtitiedot').append('<tr><td scope=row colspan=3>' + data.data + '</td></tr>');
    } else {
        var rahti = JSON.parse(data.data);

        for (var i in rahti) {
            $('#rahtitiedot').append('<tr><th scope=row>' + rahti[i]['ContainerBarCode'] + '</th><td>' + rahti[i]['Content'] + '</td></tr>');
        }
    }

}
function haeMiehisto(data=null)
{
   if (data === null) {
        var listBox = document.getElementById('laivatListBox');
        if (!listBox.options[listBox.selectedIndex]) {
            return false;
        } else {
            var id = listBox.options[listBox.selectedIndex].value;
        }

        phpKutsu('haeMiehisto=' + id, haeMiehisto);
        return true;
    }
    $('#miehistoTaulu').empty();

    if (data['status'] != 200) {
        $('#miehistoTaulu').append('<tr><td scope=row colspan=4>' + data.data + '</td></tr>');
        }
        else{
        var miehisto = JSON.parse(data.data);
        }
        for (var i in miehisto) { // onclick lisää värejä, mousehover jne.
            $('#miehistoTaulu').append('<tr onclick="valitseHenkilo(\''+ miehisto[i]['SocialID'] +'\')"><th scope=row>' + miehisto[i]['SocialID'] + '</th><td>' + miehisto[i]['FirstName'] + '</td><td>' + miehisto[i]['LastName'] + '</td><td>' + miehisto[i]['Title'] + '</td></tr>');
            }
}
function valitseHenkilo(SocialID)
{
    phpKutsu('haeHenkilo=' + SocialID, paivitaHenkilo);
}
function paivitaHenkilo(data)
{
    $('#Henkilotiedot').empty();
     if (data['status'] != 200) {
        $('#Henkilotiedot').append('<tr><td scope=row colspan=4>' + data.data + '</td></tr>');
        }
        else{
        var henkilo = JSON.parse(data.data);
        }
        for (var i in henkilo) { // onclick lisää värejä, mousehover jne.
            //$('#miehistoTaulu').append('<tr onclick="alert("'+ henkilo[i]['SocialID'] +'")"><tr><td rowspan="2"><img src="'+henkilo[i]['Picture']+ 'width="120"></img></td><td colspan="2"><b>Nimi:</b>'+henkilo[i]['FirstName']+" "+henkilo[i]['LastName']+'</td><th >Kotiosoite</th></tr><tr><td colspan="2"><b>Sotu:</b>'+henkilo[i]['SocialID']+' </td><td><table border="3" style="width: 100%" ><tr><th>Postiosoite:</th><td>'+henkilo[i]['MailingAddress']+'</td></tr><tr><th>Kaupunki:</th><td>'+henkilo[i]['City']+'</td></tr><tr><th>Postinumero:</th><td>'+henkilo[i]['ZipCode']+'</td></tr>/table></td></tr><tr><td colspan="2"><b>Titteli:</b>  '+henkilo[i]['Title']+'</td><td colspan="2"><b>Puhelin Numero:</b> '+henkilo[i]['Phone']+'</td></tr>');
            $('#Henkilotiedot').append('<tr><tr><td rowspan="2"><img id="Kuva" src="'+henkilo[i]['Picture']+ '" width="120"></img></td><td colspan="2"><b>Nimi:</b>'+henkilo[i]['FirstName']+" "+henkilo[i]['LastName']+'</td><th >Kotiosoite</th></tr><tr><td colspan="2"><b>Sotu:</b>'+henkilo[i]['SocialID']+' </td><td><table border="3" style="width: 100%" ><tr><th>Postiosoite:</th><td>'+henkilo[i]['MailingAddress']+'</td></tr><tr><th>Kaupunki:</th><td>'+henkilo[i]['City']+'</td></tr><tr><th>Postinumero:</th><td>'+henkilo[i]['ZipCode']+'</td></tr></table></td></tr><tr><td colspan="2"><b>Titteli:</b>  '+henkilo[i]['Title']+'</td><td colspan="2"><b>Puhelin Numero:</b> '+henkilo[i]['Phone']+'</td></tr>');
            var image=document.getElementById("Kuva").value;
            if(image == null || image == ''){
               document.getElementById('Kuva').src = "img/DefaultPerson.png";
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

    if (targetTab == '#kartta') {
        var listBox = document.getElementById('laivatListBox');
        if (listBox.options[listBox.selectedIndex]) {
            keskitaKartta(listBox.options[listBox.selectedIndex].value);
        }
    } else if (targetTab == '#rahti') {
        if (!haeRahti()) {
            alert('Valitse ensin laiva.');
            event.preventDefault();
            return false;
        }
    } 
    else if(targetTab == '#miehistö'){
        if(!haeMiehisto()){
            alert('Valitse ensin laiva.')
            event.preventDefault();
            return false;
        }
    }
    else {
        alert('Tabiä "' + $(event.target).attr('href') + '" ei ole implementoitu');
    }
});