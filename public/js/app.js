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

/**
 * Update tab content when the listbox item selection changes
 */
$('#laivatListBox').change(function() {
    var currentTab = $('.nav-pills li.active').find('a').attr('href');

    // TODO: Add missing functions
    if (currentTab == '#rahti') {
        haeRahti();
    } else if (currentTab == '#kartta') {
        var listBox = document.getElementById('laivatListBox');
        if (!listBox.options[listBox.selectedIndex]) {
            return false;
        } else {
            focusShip(listBox.options[listBox.selectedIndex].value);
        }
    } else if (currentTab == '#miehistö') {
        haeMiehisto();
    } else if (currentTab == '#laivantiedot') {
        haeLaivanTiedot();
    }
});

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
        $('#rahtitiedot').append('<tr><td scope=row colspan=4>' + data.data + '</td></tr>');
    } else {
        var rahti = JSON.parse(data.data);

        for (var i in rahti) {
            $('#rahtitiedot').append('<tr><td> <input type="checkbox" name="' + rahti[i]['ContainerBarCode'] + '" value=""></td><th scope=row>' + rahti[i]['ContainerBarCode'] + '</th><td>' + rahti[i]['Content'] + '</td></tr>');
        }
    }

}

function haeLaivanTiedot(data = null)
{
    if (data === null) {
        var listBox = document.getElementById('laivatListBox');
        if (!listBox.options[listBox.selectedIndex]) {
            return false;
        } else {
            var id = listBox.options[listBox.selectedIndex].value;
        }

        phpKutsu('haeLaivanTiedot=' + id, haeLaivanTiedot);
        return true;
    }

    if (data['status'] != 200) {
        alert(data.data);
    } else {
        var tiedot = JSON.parse(data.data);
        if(tiedot['StartingPort'] == null || tiedot['EndingPort'] == null ){
            $('#laivaReitti').text("Laivan reitti ei ole tiedossa.")
        }
        else{
            $('#laivaReitti').text(tiedot['StartingPort'] +" - " + tiedot['EndingPort']);
        }
        $('#laivaNimi').text(tiedot['ShipName']);
        $('#laivaMMSI').text(tiedot['MMSI']);
        $('#laivaTyyppi').text(tiedot['Name']);
        $('#laivaKuollutPaino').text(tiedot['ShipDeadWeight']+ " t");
        $('#laivaPituus').text(tiedot['ShipLength'] + " m");
        $('#laivaLeveys').text(tiedot['ShipWidth'] + " m");
        $('#laivaPaino').text(tiedot['ShipGrossTonnage'] + " t");
        $('#laivaNorth').text(tiedot['North']);
        $('#laivaEast').text(tiedot['East']);
        $('#laivanTarkkaSuunta').text(tiedot['Course']);

        draw(tiedot['Course']);

        // FIXME: olisiko joku parempikin tapa kuin joka kerralla aina luoda uusi google Map objekti?
        var sijainti = new google.maps.LatLng(tiedot['North'], tiedot['East']);
        var miniMapOptions = {
            center: sijainti,
            zoom: 8,
            streetViewControl: false
        };
        miniMap = new google.maps.Map(document.getElementById('minimap'), miniMapOptions);

        var miniMapInfoWindow = new google.maps.InfoWindow({
            content: tiedot['ShipName'] + '<br>N: ' + tiedot['North'] + '<br>E: ' + tiedot['East']
        });

        var miniMapMarker = new google.maps.Marker({
            position: sijainti,
            map: miniMap,
            title: tiedot['ShipName']
        });
        miniMapMarker.addListener('click', function() {
            miniMapInfoWindow.open(miniMap, miniMapMarker);
        });
        miniMapInfoWindow.open(miniMap, miniMapMarker);
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
        $('#miehistoTaulu').append('<tr><td scope=row colspan=5>' + data.data + '</td></tr>');
        }
        else{
        var miehisto = JSON.parse(data.data);
        }
        for (var i in miehisto) { // onclick lisää värejä, mousehover jne.
            $('#miehistoTaulu').append('<tr onclick="valitseHenkilo(this)"><td> <input type="checkbox" name="' + miehisto[i]["SocialID"] + '" value=""></td><br><th scope=row>' + miehisto[i]['SocialID'] + '</th><td>' + miehisto[i]['FirstName'] + '</td><td>' + miehisto[i]['LastName'] + '</td><td>' + miehisto[i]['Title'] + '</td></tr>');
            }
}

function valitseHenkilo(elementti)
{
    $('#miehistoTaulu tr').removeClass('bg-primary');
    $(elementti).addClass('bg-primary');
    phpKutsu('haeHenkilo=' + $(elementti).find('th:first').html(), paivitaHenkilo);
}

function tyhjennaHenkForm() {
    $('#henkLaiva').val('');
    $('#txtSotu').val('');
    $('#txtEtunimi').val('');
    $('#txtSukunimi').val('');
    $('#txtPostiosoite').val('');
    $('#txtPostinumero').val('');
    $('#txtPaikkakunta').val('');
    $('#txtPuhelin').val('');
    $('#txtTitteli').val('');
    $('#imgKuva').val('');

    $('#henkiloFormi>div>fieldset>div>div>div').removeClass('has-error');
    $('#henkiloFormi>div>fieldset>div>div>div>span').addClass('hidden');
}

function lisaaHenkilo(IMO) {
    var title = 'Lisää henkilö';
    $('#henkFormTyyppi').val('lisaa');
    $('#txtSotu').removeAttr("disabled");

    tyhjennaHenkForm();

    $('#henkLaiva').val(IMO);

    // modalin otsikko rivin väri ja otsikko
    $('#henkModalColor').removeClass('bg-warning');
    $('#henkModalColor').addClass('bg-success');
    $('#henkModalTitle').html(title);

    // modalin ns "ok" napin väri ja teksti
    $('#btnSubmithenkilö').removeClass('btn-warning');
    $('#btnSubmithenkilö').addClass('btn-success');
    $('#btnSubmithenkilö').html(title)

    // näytä modali
    $('#henkiloModal').modal('show');
}

function muokkaaHenkilo(data = null) {
    $('#henkFormTyyppi').val('muokkaa');
    $('#txtSotu').attr("disabled", "disabled");

    tyhjennaHenkForm();

    var listBox = document.getElementById('laivatListBox');
    $('#henkLaiva').val(listBox.options[listBox.selectedIndex].value);

    var sotu = $('#miehistoTaulu .bg-primary th').html();
    if (typeof sotu === 'undefined') {
        alert('Valitse ensin muokattava henkilö!');
        return false;
    }

    if (data === null) {
        phpKutsu('haeHenkilo=' + sotu, muokkaaHenkilo);
        return true;
    }

    if (data['status'] != 200) {
        alert('Henkilön tietojen hakeminen epäonnistui.');
    } else {
        var henkTiedot = JSON.parse(data.data);
        var title = 'Muokkaa henkilöä';

        // aseta tiedot tekstilaatikoihin
        $('#henkVanhaSotu').val(sotu);
        $('#txtSotu').val(henkTiedot[0]['SocialID']);
        $('#txtEtunimi').val(henkTiedot[0]['FirstName']);
        $('#txtSukunimi').val(henkTiedot[0]['LastName']);
        $('#txtPostiosoite').val(henkTiedot[0]['MailingAddress']);
        $('#txtPostinumero').val(henkTiedot[0]['ZipCode']);
        $('#txtPaikkakunta').val(henkTiedot[0]['City']);
        $('#txtPuhelin').val(henkTiedot[0]['Phone']);
        $('#txtTitteli').val(henkTiedot[0]['Title']);
        //$('#imgKuva').val(henkTiedot[0]['Picture']);

        // modalin otsikko rivin väri ja otsikko
        $('#henkModalColor').removeClass('bg-success');
        $('#henkModalColor').addClass('bg-warning');
        $('#henkModalTitle').html(title);

        // modalin ns "ok" napin väri ja teksti
        $('#btnSubmithenkilö').removeClass('btn-success');
        $('#btnSubmithenkilö').addClass('btn-warning');
        $('#btnSubmithenkilö').html(title)

        // näytä modali
        $('#henkiloModal').modal('show');
    }
}

function poistaHenk(data = null) {
    var valitutCheckboxit = $('#miehistoTaulu input:checkbox:checked');

    if (data === null) {
        if (valitutCheckboxit.length < 1) {
            alert('Valitse ensin poistettava(t) henkilö(t)!');
            return false;
        }

        if (confirm('Haluatko varmasti poistaa valitut henkilöt?')) {
            var sotut = 'poistaHenkilot[]=' + valitutCheckboxit[0].name;
            for (var i = 1; i < valitutCheckboxit.length; i++) {
                sotut += '&poistaHenkilot[]=' + valitutCheckboxit[i].name;
            }
            phpKutsu(sotut, poistaHenk);
        }
    } else {
        if (data['status'] != 200) {
            alert(data.data);
        } else {
            alert('Valitut henkilöt poistettu!');
            haeMiehisto();
        }
    }
}

function asetaVirheHenk(elementti, viesti) {
    $('#div' + elementti).addClass('has-error');
    $('#help' + elementti).removeClass('hidden');
    $('#help' + elementti).html(viesti);
}

function poistaHenkVirhe(elementti) {
    $('#help' + elementti).addClass('hidden');
    $('#div' + elementti).removeClass('has-error');
}

function validoiFormi() {
    ret = true;

    var sotu = $('#txtSotu').val();
    var etunimi = $('#txtEtunimi').val();
    var sukunimi = $('#txtSukunimi').val();
    var postiosoite = $('#txtPostiosoite').val();
    var postinumero = $('#txtPostinumero').val();
    var paikkakunta = $('#txtPaikkakunta').val();
    var puhelin = $('#txtPuhelin').val();
    var titteli = $('#txtTitteli').val();
    var regex = /\d/;
    var regexChars = /[a-z]/i;

    // FIXME: Sotun tarkistus
    // HOX HOX!: voidaan lisätä ikä ja syntymäpäivä miehistö välilehteen jos tarve tulee tämän avulla
      if (!sotutarkistus(sotu)){
        ret = false;
      }
      else {
        poistaHenkVirhe('Sotu');
      }

    if (etunimi.length > 30) {
        asetaVirheHenk('Etunimi', 'Etunimi liian pitkä! Maksimi 30 merkkiä.');
        ret = false;
    } else if (etunimi.length < 2) {
        asetaVirheHenk('Etunimi', 'Etunimi on liian lyhyt! Minimi 2 merkkiä.');
        ret = false;
    } else if (regex.test(etunimi)) {
        asetaVirheHenk('Etunimi', 'Etunimessä ei saa olla numeroita!');
        ret = false;
    } else {
        poistaHenkVirhe('Etunimi');
    }

    if (sukunimi.length > 30) {
        asetaVirheHenk('Sukunimi', 'Sukunimi liian pitkä! Maksimi 30 merkkiä.');
        ret = false
    } else if (sukunimi.length < 2) {
        asetaVirheHenk('Sukunimi', 'Sukunimi liian lyhyt! Minimi 2 merkkiä.');
        ret = false;
    } else if (regex.test(sukunimi)) {
        asetaVirheHenk('Sukunimi', 'Sukunimessä ei saa olla numeroita!');
        ret = false;
    } else {
        poistaHenkVirhe('Sukunimi');
    }

    if (postiosoite.length > 85) {
        asetaVirheHenk('Postiosoite', 'Postiosoite liian pitkä! Maksimi 85 merkkiä.');
        ret = false;
    } else if (postiosoite.length < 3) {
        asetaVirheHenk('Postiosoite', 'Postiosoite liian lyhyt! Minimi 3 merkkiä');
        ret = false;
    } else {
        poistaHenkVirhe('Postiosoite');
    }

    if (postinumero.length > 5) {
        asetaVirheHenk('Postinumero', 'Postinumero on liian pitkä! Maksimi 5 numeroa.');
        ret = false;
    } else if (postinumero.length < 5) {
        asetaVirheHenk('Postinumero', 'Postinumero liian lyhyt! Minimi 5 numeroa.');
        ret = false;
    } else if (postinumero.match(regexChars)) {
        asetaVirheHenk('Postinumero', 'Postinumeron tulee olla numeerinen!');
        ret = false;
    } else {
        poistaHenkVirhe('Postinumero');
    }

    if (paikkakunta.length > 85) {
        asetaVirheHenk('Paikkakunta', 'Paikkakunta on liian pitkä! Maksimi 85 merkkiä.');
        ret = false;
    } else if (paikkakunta.length < 2) {
        asetaVirheHenk('Paikkakunta', 'Paikkakunta on liian lyhyt! Minimi 2 merkkiä');
        ret = false;
    } else if (regex.test(paikkakunta)) {
        asetaVirheHenk('Paikkakunta', 'Paikkakunnassa ei saa olla numeroita!');
        ret = false;
    } else {
        poistaHenkVirhe('Paikkakunta');
    }

    if (puhelin.length > 20) {
        asetaVirheHenk('Puhelin', 'Puhelinnumero liian pitkä! Maksimi 20 numeroa.');
        ret = false;
    } else if (puhelin == '112' || puhelin == '911') {
        asetaVirheHenk('Puhelin', 'Puhelinnumero ei voi olla hätänumero.');
        ret = false;
    } else if (puhelin.length < 3) {
        asetaVirheHenk('Puhelin', 'Puhelinnumero liian lyhyt! Minimi 3 numeroa.');
        ret = false;
    } else if (puhelin.match(regexChars)) {
        asetaVirheHenk('Puhelin', 'Puhelinnumero ei voi sisältää muita kuin numeroita!');
        ret = false;
    } else {
        poistaHenkVirhe('Puhelin');
    }

    if (titteli.length > 60) {
        asetaVirheHenk('Titteli', 'Titteli liian pitkä! Maksimi 60 merkkiä.');
        ret = false;
    } else {
        poistaHenkVirhe('Titteli');
    }
    return ret;
}

function sotutarkistus(sotu){

        if (sotu.length != 11) {
        asetaVirheHenk('Sotu', 'Sotu on oltava 11 merkkiä.');
        return false;
        }
        var sotuSyntyma = sotu.substring(0,6);
        var sotuPaiva= sotu.substring(0,2);
        var sotuKuukausi= sotu.substring(2,4);
        var sotuVuosi= sotu.substring(4,6);
        var sotuVuosisata= sotu.substring(6,7);
        var sotuYksiloNum = sotu.substring(7,10);
        var sotuTarkistusmerkki= sotu.substring(10,11).toUpperCase();
        var tarkistusmerkki = "0123456789ABCDEFHJKLMNPRSTUVWXY";
        var tarkistusmerkkiLuku = sotuPaiva+sotuKuukausi+sotuVuosi+sotuYksiloNum;
        var tarkistusmerkkiTulos = tarkistusmerkkiLuku % 31;
        var tuloksenTarkistusmerkki = tarkistusmerkki.substring(tarkistusmerkkiTulos, tarkistusmerkkiTulos + 1);

            if(sotuPaiva <1 || sotuPaiva > 31){
             asetaVirheHenk('Sotu', 'Sotu päivä 1-31!');
             return false;
            }
            if(sotuKuukausi < 1 || sotuKuukausi >12){
             asetaVirheHenk('Sotu', 'Sotu Kuukausi 1-12!');
             return false;
            }
            if(sotuVuosisata != "-" && sotuVuosisata != "+" && sotuVuosisata != "A"){
                asetaVirheHenk('Sotu', 'Vuosisata tunnus ei täsmää!');
                return false;
            }
            if(sotuTarkistusmerkki != tuloksenTarkistusmerkki){
                asetaVirheHenk('Sotu', 'Tarkistusmerkki ei täsmää sotun kanssa!');
                return false;
            }

    return true;
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
        for (var i in henkilo) {
            $('#Henkilotiedot').append('<tr><tr><td rowspan="2"><img id="Kuva" src="'+henkilo[i]['Picture']+ '" width="120"></img></td><td colspan="2"><b>Nimi:</b>'+henkilo[i]['FirstName']+" "+henkilo[i]['LastName']+'</td><th >Kotiosoite</th></tr><tr><td colspan="2"><b>Sotu:</b>'+henkilo[i]['SocialID']+' </td><td><table border="3" style="width: 100%" ><tr><th>Postiosoite:</th><td>'+henkilo[i]['MailingAddress']+'</td></tr><tr><th>Kaupunki:</th><td>'+henkilo[i]['City']+'</td></tr><tr><th>Postinumero:</th><td>'+henkilo[i]['ZipCode']+'</td></tr></table></td></tr><tr><td colspan="2"><b>Titteli:</b>  '+henkilo[i]['Title']+'</td><td colspan="2"><b>Puhelin Numero:</b> '+henkilo[i]['Phone']+'</td></tr>');
            }
}
