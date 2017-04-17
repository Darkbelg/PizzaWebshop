<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 13:30
 */
require_once("Data/KlantDAO.php");
require_once("Exceptions/BestaatException.php");

class KlantService
{
    public function toonKlanten()
    {
        $klantDAO = new KlantDAO();
        $klanten = $klantDAO->getKlanten();
        return $klanten;
    }

    public function registreerKlant($registreerData)
    {
        $klantDAO = new KlantDAO();

        $klant = $klantDAO->create($registreerData["naam"], $registreerData["voornaam"], $registreerData["telefoon"], $registreerData["straat"], $registreerData["huisnummer"], $registreerData["stad"], $registreerData["postcode"]);

        return $klant;

    }

    public function registreerAccount($email, $wachtwoord, $getKlantNummer)
    {
            $klantDAO = new KlantDAO();
            $klant = $klantDAO->registreerAccount($email, $wachtwoord, $getKlantNummer);
            return $klant;

    }

}