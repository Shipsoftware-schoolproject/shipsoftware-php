<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Tiedostoon ekalle riville SQL käyttäjänimi ja toiselle riville salasana
$tunnarit = file('../../mysql_tunnarit.txt', FILE_IGNORE_NEW_LINES);
if ($tunnarit === false) {
	return_error('MySQL tunnuksien lataaminen ei onnistunut.');
}

if (count($tunnarit) != 2) {
	return_error('MySQL tiedoston sisältö ei ole validi');
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
	$conn = new PDO('mysql:host=mysql.cc.puv.fi;dbname=' . $tunnarit[0] . '_Shipsoftware', $tunnarit[0], $tunnarit[1]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES utf8');
} catch (PDOException $e) {
	return_error('Tietokanta yhteyden muodostaminen epäonnistui');
}

// Hae laivat
if (isset($_GET['haeLaivat'])) {
	$query = $conn->prepare('SELECT Ships.ShipID, ShipName, North, East FROM Ships LEFT JOIN GPS ON Ships.ShipID = GPS.ShipID where LogID in (select max(LogID)from GPS group by shipID)');
	try {
		$query->execute();
	} catch (PDOException $e) {
		return_error('Virhe SQL -kyselyssä');
	}

	$laivat = array();
	$i = 0;

	while ($row = $query->fetch()) {
		$laivat[$i]['ShipID'] = $row['ShipID'];
		$laivat[$i]['ShipName'] = $row['ShipName'];
		$laivat[$i]['North'] = $row['North'];
		$laivat[$i]['East'] = $row['East'];
		$i++;
	}

	if ($i == 0) {
		return_error('Laivoja ei löytynyt', 206);
	}

	return_success($laivat);
}

// Hae Miehistö
if (isset($_GET['haeMiehisto'])) {
	if (!is_numeric($_GET['haeMiehisto']) || $_GET['haeMiehisto'] < 0) {
		return_error('Pätemätön parametri!', 400);
	}else {
		$query = $conn->prepare('SELECT FirstName, LastName, SocialID, Title 
								FROM Persons Where ShipID = :ShipID');
			$query->bindParam(':ShipID', $_GET['haeMiehisto'], PDO::PARAM_INT);
		try {
			$query->execute();
		} catch (PDOException $e) {
			return_error('Virhe SQL -kyselyssä');
		}
		$miehisto = array();
		$i = 0;

		while ($row = $query->fetch()) {
			$miehisto[$i]['SocialID'] = $row['SocialID'];
			$miehisto[$i]['FirstName'] = $row['FirstName'];
			$miehisto[$i]['LastName'] = $row['LastName'];
			$miehisto[$i]['Title']	= $row['Title'];
			$i++;
		}
		if ($i == 0){
			return_error('Laivalla ei ole miehistöä!',206);
		}
		return_success($miehisto);
		}
}
//haeHenkilo
 if (isset($_GET['haeHenkilo'])) {
	if (strlen($_GET['haeHenkilo']) <=9  || strlen($_GET['haeHenkilo']) > 10) {
		return_error('Pätemätön parametri!', 400);
	}else {
		$query = $conn->prepare('SELECT * FROM Persons Where SocialID = :SocialID');
			$query->bindParam(':SocialID', $_GET['haeHenkilo'], PDO::PARAM_STR);
		try {
			$query->execute();
		} catch (PDOException $e) {
			return_error('Virhe SQL -kyselyssä');
		}
		$henkilo = array();
		$i = 0;

		while ($row = $query->fetch()) {
			$henkilo[$i]['SocialID'] = $row['SocialID'];
			$henkilo[$i]['FirstName'] = $row['FirstName'];
			$henkilo[$i]['LastName'] = $row['LastName'];
			$henkilo[$i]['Title']	= $row['Title'];
			$henkilo[$i]['Phone']	= $row['Phone'];
			$henkilo[$i]['ZipCode']	= $row['ZipCode'];
			$henkilo[$i]['City']	= $row['City'];
			$henkilo[$i]['MailingAddress']	= $row['MailingAddress'];
			$henkilo[$i]['Picture']	= $row['Picture'];
			$i++;
		}
		if ($i == 0){
			return_error('Laivalla ei ole miehistöä!',206);
		}
		return_success($henkilo);
		}
}
// Laivan Tiedot
if (isset($_GET['haeLaivanTiedot'])) {
	if (!is_numeric($_GET['haeLaivanTiedot']) || $_GET['haeLaivanTiedot'] < 0) {
		return_error('Pätemätön parametri!', 400);
	} else {
		$query = $conn->prepare('SELECT(SELECT Name 
										from ShipPorts 
										inner join ShipRoutes on ShipPortID = StartingPortID 
										inner join Ships on Ships.ShipRoutesID = ShipRoutes.ShipRoutesID 
										Where ShipID=:ShipID ) as StartingPort,
										 (SELECT Name from ShipPorts 
										 inner join ShipRoutes on ShipPortID = EndingPortID 
										 inner join Ships on Ships.ShipRoutesID = ShipRoutes.ShipRoutesID 
										 Where ShipID=:ShipID ) as EndingPort,
										 Ships.ShipID,ShipName,Name,ShipLength,ShipWidth,ShipDraft,ShipDeadWeight,ShipGrossTonnage,MMSI,Course,IsSailing,ShipSpeed,North,East,MAX(LogID) 
										 FROM Ships 
										 INNER JOIN GPS ON Ships.ShipID = GPS.ShipID
										 INNER JOIN ShipTypes ON Ships.ShipTypeID = ShipTypes.ShipTypeID
										 WHERE Ships.ShipID = :ShipID ');
		$query->bindParam(':ShipID', $_GET['haeLaivanTiedot'], PDO::PARAM_INT);
		try {
			$query->execute();
		} catch (PDOException $e) {
			return_error('Virhe SQL -kyselyssä');
		}

		$laivanTiedot = array();

		$row = $query->fetch();

		$laivanTiedot['ShipName'] = $row['ShipName'];
		$laivanTiedot['StartingPort'] = $row['StartingPort'];
		$laivanTiedot['EndingPort'] = $row['EndingPort'];
		$laivanTiedot['Name'] = $row['Name'];
		$laivanTiedot['ShipLength'] = $row['ShipLength'];
		$laivanTiedot['ShipWidth'] = $row['ShipWidth'];
		$laivanTiedot['ShipDraft'] = $row['ShipDraft'];
		$laivanTiedot['ShipDeadWeight'] = $row['ShipDeadWeight'];
		$laivanTiedot['ShipGrossTonnage'] = $row['ShipGrossTonnage'];
		$laivanTiedot['MMSI'] = $row['MMSI'];
		$laivanTiedot['Course'] = $row['Course'];
		$laivanTiedot['IsSailing'] = $row['IsSailing'];
		$laivanTiedot['ShipSpeed'] = $row['ShipSpeed'];
		$laivanTiedot['North'] = $row['North'];
		$laivanTiedot['East'] = $row['East'];

		if (!count($laivanTiedot)) {
			return_error('Laivalla ei ole tietoja', 206);
		}

		return_success($laivanTiedot);
	}
}
// Hae rahti
if (isset($_GET['haeRahti'])) {
	if (!is_numeric($_GET['haeRahti']) || $_GET['haeRahti'] < 0) {
		return_error('Pätemätön parametri!', 400);
	} else {
		$query = $conn->prepare('SELECT Cargo.CargoID, ContainerBarCode, CargoType, OverallWeight FROM Cargo
								 INNER JOIN CargoContainer
								 ON Cargo.CargoID = CargoContainer.CargoID
								 WHERE ShipID = :ShipID');
		$query->bindParam(':ShipID', $_GET['haeRahti'], PDO::PARAM_INT);
			try {
				$query->execute();
			} catch (PDOException $e) {
				return_error('Virhe SQL -kyselyssä');
			}

		$rahti = array();
		$i = 0;

		while ($row = $query->fetch()) {
			$rahti[$i]['ContainerBarCode'] = $row['ContainerBarCode'];
			$rahti[$i]['Content'] = $row['CargoType'];
			$rahti[$i]['OverallWeight'] = $row['OverallWeight'];
			$i++;
		}

		if ($i == 0) {
			return_error('Laivalla ei ole rahtia', 206);
		}

		return_success($rahti);
	}
}

return_error('Tuntematon pyyntö', 400);
?>
