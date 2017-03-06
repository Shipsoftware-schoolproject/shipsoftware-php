<?php

# Tiedostoon ekalle riville SQL käyttäjänimi ja toiselle riville salasana
$tunnarit = file("../../mysql_tunnarit.txt", FILE_IGNORE_NEW_LINES);
if ($fd === false) {
	display_error("MySQL tunnuksien lataaminen ei onnistunut.");
}

if (count($tunnarit)) != 2) {
	display_error("MySQL tiedoston sisältö ei ole validi");
}

function display_error($message, $error_code = 500)
{
	echo $message;
	http_response_code($error_code);
	die();
}

$conn = mysqli_connect("mysql.cc.puv.fi", $tunnarit[0], $tunnarit[1], $tunnarit[0] . "_Kurssi");

if (!$conn) {
    display_error("Tietokanta yhteyden muodostaminen epäonnistui");
}

?>