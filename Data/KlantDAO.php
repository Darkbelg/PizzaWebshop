<?php
// TODO CRUD
//TODO aanpassen alle klanten

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
require_once "Data/StraatDAO.php";
require_once "Data/StadDAO.php";
require_once "Exception/BestaatException";


class KlantDAO
{
	public function getKlanten()
	{
		$dbh=DBConfig::openConnectie();
		$sql = "SELECT klantNummer,naam,voornaam,telefoon, emailadres as email,wachtwoord,opmerking,promo,beheerder,
stad.id as stadId,postcode,stad,
straat.id as straatId,straat,huisnummer 
FROM klant INNER JOIN stad on klant.stadId = stad.id 
INNER JOIN straat on straat.id = klant.straatId";
		$resultSet = $dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij){
			$straat = Straat::create($rij["straatId"],$rij["straat"],$rij["huisnummer"]);
			$stad = Stad::create($rij["stadId"],$rij["postcode"],$rij["stad"]);
			$klant = Klant::create($rij["klantNummer"],$rij["naam"],$rij["voornaam"],$rij["telefoon"],$rij["email"],$rij["wachtwoord"],$rij["opmerking"],$rij["promo"],$rij["beheerder"],$stad,$straat);
			array_push($lijst,$klant);
		}
		$dbh=DBConfig::sluitConnectie();
		return $lijst;

	}

	public function getAccountByEmail($email)
	{
		$dbh = DBConfig::openConnectie();
		$sql = "SELECT klantNummer,naam,voornaam,telefoon, emailadres as email,wachtwoord,opmerking,promo,beheerder,
stad.id as stadId,postcode,stad,
straat.id as straatId,straat,huisnummer 
FROM klant INNER JOIN stad on klant.stadId = stad.id 
INNER JOIN straat on straat.id = klant.straatId
where emailadres = :email";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(":email"=>$email));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$straat = Straat::create($rij["straatId"],$rij["straat"],$rij["huisnummer"]);
		$stad = Stad::create($rij["stadId"],$rij["postcode"],$rij["stad"]);
		$klant = Klant::create($rij["klantNummer"],$rij["naam"],$rij["voornaam"],$rij["telefoon"],$rij["email"],$rij["wachtwoord"],$rij["opmerking"],$rij["promo"],$rij["beheerder"],$stad,$straat);
		return $klant;
	}
	public function getAccountById($klantNummer)
	{
		$dbh = DBConfig::openConnectie();
		$sql = "SELECT klantNummer,naam,voornaam,telefoon, emailadres as email,wachtwoord,opmerking,promo,beheerder,
stad.id as stadId,postcode,stad,
straat.id as straatId,straat,huisnummer 
FROM klant INNER JOIN stad on klant.stadId = stad.id 
INNER JOIN straat on straat.id = klant.straatId
where klantNummer = :klantNummer";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(":klantNummer"=>$klantNummer));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$straat = Straat::create($rij["straatId"],$rij["straat"],$rij["huisnummer"]);
		$stad = Stad::create($rij["stadId"],$rij["postcode"],$rij["stad"]);
		$klant = Klant::create($rij["klantNummer"],$rij["naam"],$rij["voornaam"],$rij["telefoon"],$rij["email"],$rij["wachtwoord"],$rij["opmerking"],$rij["promo"],$rij["beheerder"],$stad,$straat);
		return $klant;
	}

	public function create($naam,$voornaam,$telefoon,$straat,$huisnummer,$stad,$postcode,$email="",$wachtwoord="")
	{

		//TODO aanmaken van de klant

		$stadDao = new StadDAO();
		$straatDao=new StraatDAO();

		try {
			$stad = $stadDao->create($stad,$postcode);
		}
		catch (BestaatException $ex){
			$stad = $stadDao->getByStad($stad);
		}
		try {
			$straat = $straatDao->create($straat, $huisnummer);
		}
		catch (BestaatException $ex){
			$straat = $straatDao->getByStraat($straat, $huisnummer);
		}
		$dbh = DBConfig::openConnectie();
		$sql = "insert into klant naam=:naam,voornaam=:voornaam,telefoon=:telefoon,emailadres=:email,wachtwoord=:wachtwoord,stadId=:stadId,straatIs=:straatId";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(":naam"=>$naam,":voornaam"=>$voornaam,":telefoon"=>$telefoon,":email"=>$email,":wachtwoord"=>$wachtwoord,":stadId"=>$stad->getId(),":straatId"=>$straat->getId()));
		$id = $dbh->lastInsertId();
		$dbh = DBConfig::sluitConnectie();
		$klant = $this->getAccountById($id);
		return $id;

	}


}