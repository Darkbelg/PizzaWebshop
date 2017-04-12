<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:53
 */
require_once "DBConfig.php";
require_once "Entities/Straat.php";
require_once "Entities/Stad.php";
require_once "Entities/Klant.php";

class KlantDAO
{
	public function getKlanten()
	{
		$dbh=DBConfig::openConnectie();
		$sql = "SELECT klantNummer,naam,voornaam,telefoon, emailadres as email,wachtwoord,opmerking,promo,beheerder,
plaats.plaatsId as pId,postcode,stad,
straat.straatId as sId,straat,huisnummer 
FROM klant INNER JOIN plaats on klant.plaatsId = plaats.plaatsId 
INNER JOIN straat on straat.straatId = klant.straatId";
		$resultSet = $dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij){
			$straat = Straat::create($rij["sId"],$rij["straat"],$rij["huisnummer"]);
			$stad = Stad::create($rij["pId"],$rij["postcode"],$rij["stad"]);
			$klant = Klant::create($rij["klantNummer"],$rij["naam"],$rij["voornaam"],$rij["telefoon"],$rij["email"],$rij["wachtwoord"],$rij["opmerking"],$rij["promo"],$rij["beheerder"],$stad,$straat);
			array_push($lijst,$klant);
		}
		$dbh=DBConfig::sluitConnectie();
		return $lijst;

	}
}