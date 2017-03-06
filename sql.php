<?php

$tunnarit = array();

# Tiedostoon ekalle riville SQL käyttäjänimi ja toiselle riville salasana
$fd = fopen("../../mysql_tunnarit.tx", "r");
if ($fd) {
	$i = 0;
	while (($line = fgets($fd)) !== false) {
		$tunnarit[$i] = $line;
		$i++;
	}
} else {
	echo "MySQL tunnuksien lataaminen ei onnistunut.";
	http_response_code(500);
	die();
}

$conn = mysqli_connect("mysql.cc.puv.fi", $tunnarit[0], $tunnarit[1], $tunnarit[0] . "_Kurssi");

if (!$conn ) {
    echo "Connection could not be established.<br />";
}

?>