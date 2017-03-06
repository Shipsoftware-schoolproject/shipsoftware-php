<?php

$tunnarit = array();

# Tiedostoon ekalle riville SQL käyttäjänimi ja toiselle riville salasana
$fd = fopen("../../mysql_tunnarit.txt", "r");
if ($fd) {
	$i = 0;
	while (($line = fgets($fd)) !== false) {
		$tunnarit[$i] = $line;
		$i++;
	}
} else {
	echo "";
}
echo "username: \"$tunnarit[0]\"";

$conn = mysqli_connect("mysql.cc.puv.fi", $tunnarit[0], $tunnarit[1], "e1501153_Kurssi");

if (!$conn ) {
    echo "Connection could not be established.<br />";
} else {
	echo "Success<br />";
}
?>