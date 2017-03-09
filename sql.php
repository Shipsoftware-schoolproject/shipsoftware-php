<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Tiedostoon ekalle riville SQL käyttäjänimi ja toiselle riville salasana
$tunnarit = file("../../mysql_tunnarit.txt", FILE_IGNORE_NEW_LINES);
if ($tunnarit === false) {
	return_error("MySQL tunnuksien lataaminen ei onnistunut.");
}

if (count($tunnarit) != 2) {
	return_error("MySQL tiedoston sisältö ei ole validi");
}

// Käytä kun tarvitsee palauttaa virhe
function return_error($message, $error_code = 500)
{
	echo $message;
	http_response_code($error_code);
	die();
}

// Käytä kun kaikki on OK
function return_success($message)
{
	echo json_encode($message);
	die();
}

try {
	$conn = new PDO("mysql:host=mysql.cc.puv.fi;dbname=" . $tunnarit[0] . "_Shipsoftware", $tunnarit[0], $tunnarit[1]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES utf8');
} catch (PDOException $e) {
	return_error("Tietokanta yhteyden muodostaminen epäonnistui");
}

// Hae laivat
if (isset($_GET['haeLaivat'])) {
	$query = $conn->prepare('SELECT ShipID, ShipName FROM Ships');
	$query->execute();

	$laivat = array();
	$i = 0;

	while ($row = $query->fetch()) {
		$laivat[$i]['ShipID'] = $row['ShipID'];
		$laivat[$i]['ShipName'] = $row['ShipName'];
		$i++;
	}

	return_success($laivat);
}

// Hae rahti
if (isset($_GET['haeRahti'])) {
	if (!is_numeric($_GET['haeRahti']) || $_GET['haeRahti'] < 0) {
		return_error("Pätemätön parametri!", 400);
	} else {
		$query = $conn->prepare('SELECT Cargo.CargoID, ContainerBarCode, CargoType, OverallWeight FROM Cargo
								 INNER JOIN CargoContainer 
								 ON Cargo.CargoID = CargoContainer.CargoID 
								 WHERE ShipID = :ShipID');
		$query->bindParam(':ShipID', $_GET['haeRahti'], PDO::PARAM_INT);
		//try {
			$query->execute();
		//} catch (PDOException $e) {
		//	return_error("Virhe SQL -kyselyssä");
		//}

		$rahti = array();
		$i = 0;

		while ($row = $query->fetch()) {
			$rahti[$i]['ContainerBarCode'] = $row['ContainerBarCode'];
			$rahti[$i]['Content'] = $row['CargoType'];
			$rahti[$i]['OverallWeight'] = $row['OverallWeight'];
			$i++;
		}

		return_success($rahti);
	}
}

return_error("Tuntematon pyyntö", 400);

?>
