// FIXME: Fix this..
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
            focus_ship(listBox.options[listBox.selectedIndex].value);
        }
    } else if (targetTab == '#rahti') {
        if (!haeRahti()) {
            alert('Valitse ensin laiva.');
            event.preventDefault();
            return false;
        }
    } else if (targetTab == '#miehistö'){
        if (!haeMiehisto()){
            alert('Valitse ensin laiva.');
            event.preventDefault();
            return false;
        }
    } else if (targetTab == '#laivantiedot') {
        if (!haeLaivanTiedot()) {
            alert('Valitse ensin laiva.');
            event.preventDefault();
            return false;
        }
    } else {
        alert('Tabiä "' + $(event.target).attr('href') + '" ei ole implementoitu');
    }
});