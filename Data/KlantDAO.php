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
require_once "Exceptions/BestaatException.php";


class KlantDAO
{
    public function getAll()
    {
        $dbh = DBConfig::openConnectie();
        $sql = "SELECT klantNummer,naam,voornaam,telefoon, emailadres as email,wachtwoord,opmerking,promo,beheerder,
stad.id as stadId,postcode,stad,
straat.id as straatId,straat,huisnummer 
FROM klant INNER JOIN stad on klant.stadId = stad.id 
INNER JOIN straat on straat.id = klant.straatId";
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $straat = Straat::create($rij["straatId"], $rij["straat"], $rij["huisnummer"]);
            $stad = Stad::create($rij["stadId"], $rij["postcode"], $rij["stad"]);
            $klant = Klant::create($rij["klantNummer"], $rij["naam"], $rij["voornaam"], $rij["telefoon"], $rij["email"], $rij["wachtwoord"], $rij["opmerking"], $rij["promo"], $rij["beheerder"], $stad, $straat);
            array_push($lijst, $klant);
        }
        $dbh = DBConfig::sluitConnectie();
        return $lijst;

    }

    public function getByEmail($email)
    {
        $dbh = DBConfig::openConnectie();
        $sql = "SELECT klantNummer,naam,voornaam,telefoon, emailadres as email,wachtwoord,opmerking,promo,beheerder,
stad.id as stadId,postcode,stad,
straat.id as straatId,straat,huisnummer 
FROM klant INNER JOIN stad on klant.stadId = stad.id 
INNER JOIN straat on straat.id = klant.straatId
where emailadres = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":email" => $email));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $straat = Straat::create($rij["straatId"], $rij["straat"], $rij["huisnummer"]);
        $stad = Stad::create($rij["stadId"], $rij["postcode"], $rij["stad"]);
        $klant = Klant::create($rij["klantNummer"], $rij["naam"], $rij["voornaam"], $rij["telefoon"], $rij["email"], $rij["wachtwoord"], $rij["opmerking"], $rij["promo"], $rij["beheerder"], $stad, $straat);
        return $klant;
    }

    public function getById($klantNummer)
    {
        $dbh = DBConfig::openConnectie();
        $sql = "SELECT klantNummer,naam,voornaam,telefoon, emailadres as email,wachtwoord,opmerking,promo,beheerder,
stad.id as stadId,postcode,stad,
straat.id as straatId,straat,huisnummer 
FROM klant INNER JOIN stad on klant.stadId = stad.id 
INNER JOIN straat on straat.id = klant.straatId
where klantNummer = :klantNummer";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":klantNummer" => $klantNummer));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $straat = Straat::create($rij["straatId"], $rij["straat"], $rij["huisnummer"]);
        $stad = Stad::create($rij["stadId"], $rij["postcode"], $rij["stad"]);
        $klant = Klant::create($rij["klantNummer"], $rij["naam"], $rij["voornaam"], $rij["telefoon"], $rij["email"], $rij["wachtwoord"], $rij["opmerking"], $rij["promo"], $rij["beheerder"], $stad, $straat);
        return $klant;
    }


    /**
     * Alle gegevens voor een nieuwe klant maar geen email of wachtwoord
     * @param $naam
     * @param $voornaam
     * @param $telefoon
     * @param $straat
     * @param $huisnummer
     * @param $stad
     * @param $postcode
     * @return klant
     */

    public function create($naam, $voornaam, $telefoon, $straat, $huisnummer, $stad, $postcode)
    {
        $bestaatKlant = $this->bestaatKlant($naam, $voornaam, $telefoon);

        if ($bestaatKlant) {

            return $klant = $this->getById($bestaatKlant);
        }

        $stadDao = new StadDAO();
        $straatDao = new StraatDAO();

        try {
            $stad = $stadDao->create($stad, $postcode);
        } catch (BestaatException $ex) {
            $stad = $stadDao->getByNaam($stad);
        }
        try {
            $straat = $straatDao->create($straat, $huisnummer);
        } catch (StraatBestaatException $ex) {
            $straat = $straatDao->getByStraat($straat, $huisnummer);
        }

        $dbh = DBConfig::openConnectie();
        $sql = "insert into klant(naam,voornaam,telefoon,stadId,straatId) VALUES (:naam,:voornaam,:telefoon,:stadId,:straatId)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":naam" => $naam, ":voornaam" => $voornaam, ":telefoon" => $telefoon, ":stadId" => $stad->getId(), ":straatId" => $straat->getId()));

        $id = $dbh->lastInsertId();
        $dbh = DBConfig::sluitConnectie();
        $klant = $this->getById($id);

        return $klant;
    }

	/**
	 * @param $naam
	 * @param $voornaam
	 * @param $telefoon
	 * @return klantnummer
	 */
    private function bestaatKlant($naam, $voornaam, $telefoon)
    {
        $dbh = DBConfig::openConnectie();
        $sql = "select klantNummer from klant where naam=:naam and voornaam=:voornaam and telefoon=:telefoon";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":naam" => $naam, ":voornaam" => $voornaam, ":telefoon" => $telefoon));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rij["klantNummer"];
    }

    public function registreerAccount($email, $wachtwoord, $klantNummer)
    {
        $wachtHash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $dbh = DBConfig::openConnectie();
        $sql = "update klant set emailadres=:email,wachtwoord=:wachtwoord WHERE klantNummer=:klantNummer ";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":email" => $email, ":wachtwoord" => $wachtHash, ":klantNummer" => $klantNummer));

        $dbh = DBConfig::sluitConnectie();
        $klant = $this->getById($klantNummer);
        return $klant;
    }



}