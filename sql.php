<?php

# Tiedostoon ekalle riville SQL käyttäjänimi ja toiselle riville salasana
$tunnarit = file("../../mysql_tunnarit.txt", FILE_IGNORE_NEW_LINES);
if ($tunnarit === false) {
	display_error("MySQL tunnuksien lataaminen ei onnistunut.");
}

if (count($tunnarit) != 2) {
	display_error("MySQL tiedoston sisältö ei ole validi");
}

function display_error($message, $error_code = 500)
{
	echo $message;
	http_response_code($error_code);
	die();
}

try {
	//$conn = mysqli_connect("mysql.cc.puv.fi", $tunnarit[0], $tunnarit[1], $tunnarit[0] . "_Kurssi");
	$conn = new PDO("mysql:host=mysql.cc.puv.fi;dbname=" . $tunnarit[0] . "_Shipsoftware", $tunnarit[0], $tunnarit[1]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES utf8');
} catch (PDOException $e) {
	display_error("Tietokanta yhteyden muodostaminen epäonnistui");
}

?>