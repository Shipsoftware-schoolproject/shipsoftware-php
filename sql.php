<?php

# mysql_tunnarit.txt:
# 1. rivi: tietokannan nimi
# 2. rivi: käyttäjänimi
# 3. rivi: salasana

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tunnarit_file = '';
if (gethostname() == 'shell.vamk.fi') {
	$tunnarit_file = '../../mysql_tunnarit.txt';
} else {
	$tunnarit_file = '../mysql_tunnarit.txt';
}

$tunnarit = file($tunnarit_file, FILE_IGNORE_NEW_LINES);
if ($tunnarit === false) {
	return_error('MySQL tunnuksien lataaminen ei onnistunut.');
}

if (count($tunnarit) != 3) {
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
	$conn = new PDO('mysql:host=mysql.cc.puv.fi;dbname=' . $tunnarit[0], $tunnarit[1], $tunnarit[2]);
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

// Kuvan näyttäminen
if (isset($_GET['haeKuva'])) {
	$query = $conn->prepare('SELECT Picture FROM Persons Where SocialID = :SocialID');
	$query->bindParam(':SocialID', $_GET['haeKuva'], PDO::PARAM_STR);

	try {
		$query->execute();
	} catch (PDOException $e) {
		return_error('Virhe SQL -kyselyssä');
	}

	$row = $query->fetch();

	if ($row) {
		header("Content-type: image/jpeg");
		echo $row['Picture'];
	}

	die();
}

//haeHenkilo
 if (isset($_GET['haeHenkilo'])) {
	if (strlen($_GET['haeHenkilo']) != 11) {
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
			if (!$row['Picture']) {
				$henkilo[$i]['Picture'] = 'img/DefaultPerson.png';
			} else {
				$henkilo[$i]['Picture']	= 'sql.php?haeKuva=' . $row['SocialID'];
			}

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
		$query = $conn->prepare('SELECT(SELECT Name from ShipPorts inner join ShipRoutes on ShipPortID = StartingPortID inner join Ships on Ships.ShipRoutesID = ShipRoutes.ShipRoutesID Where ShipID=:ShipID ) as StartingPort, (SELECT Name from ShipPorts inner join ShipRoutes on ShipPortID = EndingPortID inner join Ships on Ships.ShipRoutesID = ShipRoutes.ShipRoutesID Where ShipID=:ShipID ) as EndingPort, Ships.ShipID,ShipName,Name,ShipLength,ShipWidth,ShipDraft,ShipDeadWeight,ShipGrossTonnage,MMSI,Course,IsSailing,ShipSpeed,North,East,MAX(LogID) FROM Ships INNER JOIN GPS ON Ships.ShipID = GPS.ShipID INNER JOIN ShipTypes ON Ships.ShipTypeID = ShipTypes.ShipTypeID WHERE Ships.ShipID = :ShipID and LogID in (select max(LogID)from GPS group by shipID)');
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

// Poista valitut henkilöt
if (isset($_GET['poistaHenkilot'])) {
	$henkilot = $_GET['poistaHenkilot'];
	if (count($henkilot) < 1) {
		return_error('Liian vähän henkilöitä.', 206);
	}

	$delete_clause = '?';
	for ($i = 1; $i < count($henkilot); $i++) {
		$delete_clause .= ' AND SocialID = ?';
	}

	$query = $conn->prepare('DELETE FROM Persons WHERE SocialID = ' . $delete_clause . ';');
	for ($i = 0; $i < count($henkilot); $i++) {
		$query->bindParam(($i + 1), $henkilot[$i], PDO::PARAM_STR);
	}

	try {
		$query->execute();
	} catch (PDOException $e) {
		return_error('Virhe SQL-kyselyssä');
	}

	return_success('');
}

// Lisää/muokkaa henkilö
if (isset($_POST['henkFormTyyppi'])) {
	$ShipID = $_POST['henkLaiva'];
	$Sotu = $_POST['txtSotu'];
	$Etunimi = $_POST['txtEtunimi'];
	$Sukunimi = $_POST['txtSukunimi'];
	$Postiosoite = $_POST['txtPostiosoite'];
	$Postinumero = $_POST['txtPostinumero'];
	$Paikkakunta = $_POST['txtPaikkakunta'];
	$Puhelin = $_POST['txtPuhelin'];
	$Titteli = $_POST['txtTitteli'];
	$Kuva = null;

	if ($_FILES['imgKuva']['error'] != 4) {
		if ($_FILES['imgKuva']['error'] != 0) {
			return_error('Virhe kuvan latauksessa (PHP): ' . $_FILES['imgKuva']['error'] . 'nimi:' . isset($_FILES['imgKuva']['name']));
		}

		// Tietokannassa kuva on vielä LONGBLOB (4GB), mutta tässä tarkistus MEDIUMBLOB:lle (16MB)
		if ($_FILES['imgKuva']['size'] > 16777215) {
			return_error('Kuva on liian suuri (maksimi koko 16MB).');
		}

		if (($Kuva = file_get_contents($_FILES['imgKuva']['tmp_name'])) === false) {
			return_error('Virhe ladatessa kuvaa väliaikaistiedostosta.');
		}
	}

	// Lisääminen
	if ($_POST['henkFormTyyppi'] == 'lisaa') {
		$query = $conn->prepare('INSERT INTO `Persons`(`ShipID`, `Title`, `SocialID`, `FirstName`, `LastName`, `Phone`, `ZipCode`, `City`, `MailingAddress`, `Picture`)
		 VALUES (:ShipID,:Title,:SocialID,:FirstName,:LastName,:Phone,:ZipCode,:City,:MailingAddress,:Picture)');
		$query->bindParam(':ShipID', $ShipID, PDO::PARAM_INT);
		$query->bindParam(':Title', $Titteli, PDO::PARAM_INT);
		$query->bindParam(':SocialID', $Sotu, PDO::PARAM_INT);
		$query->bindParam(':FirstName', $Etunimi, PDO::PARAM_INT);
		$query->bindParam(':LastName', $Sukunimi, PDO::PARAM_INT);
		$query->bindParam(':Phone', $Puhelin, PDO::PARAM_INT);
		$query->bindParam(':ZipCode', $Postinumero, PDO::PARAM_INT);
		$query->bindParam(':City', $Paikkakunta, PDO::PARAM_INT);
		$query->bindParam(':MailingAddress', $Postiosoite, PDO::PARAM_INT);
		$query->bindParam(':Picture', $Kuva);
	// Muokkaaminen
	} else if ($_POST['henkFormTyyppi'] == 'muokkaa') {
		if ($Kuva == null) {
			$sql = 'UPDATE `Persons` SET `ShipID`=:ShipID,`Title`=:Title,`FirstName`=:FirstName,`LastName`=:LastName,`Phone`=:Phone,`ZipCode`=:ZipCode,`City`=:City,`MailingAddress`=:MailingAddress WHERE SocialID = :SocialID';
		} else {
			$sql = 'UPDATE `Persons` SET `ShipID`=:ShipID,`Title`=:Title,`FirstName`=:FirstName,`LastName`=:LastName,`Phone`=:Phone,`ZipCode`=:ZipCode,`City`=:City,`MailingAddress`=:MailingAddress `Picture`=:Picture WHERE SocialID = :SocialID';
			$query->bindParam(':Picture', $Kuva);
		}
		$query = $conn->prepare($sql);
		$query->bindParam(':ShipID', $ShipID, PDO::PARAM_INT);
		$query->bindParam(':Title', $Titteli, PDO::PARAM_INT);
		$query->bindParam(':SocialID', $Sotu, PDO::PARAM_INT);
		$query->bindParam(':FirstName', $Etunimi, PDO::PARAM_INT);
		$query->bindParam(':LastName', $Sukunimi, PDO::PARAM_INT);
		$query->bindParam(':Phone', $Puhelin, PDO::PARAM_INT);
		$query->bindParam(':ZipCode', $Postinumero, PDO::PARAM_INT);
		$query->bindParam(':City', $Paikkakunta, PDO::PARAM_INT);
		$query->bindParam(':MailingAddress', $Postiosoite, PDO::PARAM_INT);
	} else {
		return_error('Tuntematon pyyntö', 400);
	}

	try {
		$query->execute();
	} catch (PDOException $e) {
		return_error('Virhe SQL -kyselyssä.');
	}

	if ($_POST['henkFormTyyppi'] == 'lisaa') {
		return_success('Henkilö lisätty!');
	} else if ($_POST['henkFormTyyppi'] == 'muokkaa') {
		return_success('Tiedot muokattu onnistuneesti!');
	} else {
		return_error('Tuntematon pyyntö', 400);
	}
}

return_error('Tuntematon pyyntö', 400);
?>
