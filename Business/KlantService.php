<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 13:30
 */
require_once("Data/KlantDAO.php");
require_once("Data/StadDAO.php");
require_once("Exceptions/BestaatException.php");
require_once("Exceptions/BuitenLevergebiedException.php");
require_once ("Data/ZaakDAO.php");

class KlantService
{
	public function getAll()
	{
		$klantDAO = new KlantDAO();
		$klanten = $klantDAO->getAll();
		return $klanten;
	}

	public function create($registreerData)
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

	public function getById($klantNummer)
	{
		$klantDAO = new KlantDAO();
		$klant = $klantDAO->getById($klantNummer);
		$klant->setWachtwoord("");
		return $klant;
	}

	public function controleerRegio($stad)
	{
		$stadDao = new StadDAO();
		$leverGebied = $stadDao->getLevergebied();
		$stad = $stadDao->getByNaam($stad);
		if (array_search($stad, $leverGebied) === false) {
			throw new BuitenLevergebiedException();
		}
	}

	public function toonLeverGebied()
	{
		$stadDao = new StadDAO();
		$lijst = $stadDao->getLevergebied();
		return $lijst;
	}

	public function isBeheerder($klantNummer)
	{
		$klantDao = new KlantDAO();
		return ($klantDao->getById($klantNummer)->getBeheerder())==1;
	}


	public function updateOpmerking($klantnummer,$opmerking)
	{
		$klantDao = new KlantDAO();
		$klantDao->updateOpmerking($klantnummer,$opmerking);

	}

	public function setAanmerkingPromo($klantNummer)
	{
		//opvragen hoeveel keer hij besteld heeft
		$klantDao = new KlantDAO();
		$klantDao->setAanmerkingPromo($klantNummer);

	}

	public function getInPromoPeriode()
	{
		$zaakDao = new ZaakDAO();
		$vandaag = new DateTime("now");
		$bool = $zaakDao->getPromo($vandaag->format("Y-m-d"));
		return $bool;
	}
}