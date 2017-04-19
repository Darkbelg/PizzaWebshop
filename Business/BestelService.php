<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 18/04/2017
 * Time: 14:28
 */
require_once "Data/BestellingenDAO.php";
require_once "Data/StraatDAO.php";
require_once "Data/StadDAO.php";
require_once "Exceptions/StraatBestaatException.php";


class BestelService{
	public function nieuweBestelling($datum,$tijdstip,$klantNummer,$straat,$huisnummer,$stad,$bestellijnen)
	{
		$bestellingDao= new BestellingenDAO();
		$straatDao = new StraatDAO();
		$stadDao = new StadDAO();
		try{
			$straat = $straatDao->create($straat,$huisnummer);
		}catch (StraatBestaatException $ex){
			$straat = $straatDao->getByStraat($straat,$huisnummer);
		}
		$stad = $stadDao->getByNaam($stad);
		$bestellingen = $bestellingDao->create($datum,$tijdstip,$klantNummer,$straat->getId(),$stad->getId());


		$this->nieuwBestellijn($bestellijnen,$bestellingen->getId());

		return $bestellingen;

	}

	public function nieuwBestellijn($bestellijnen,$bestellingId)
	{
		$bestellingDao = new BestellingenDAO();

		foreach ( $bestellijnen as $bestellijn){
			$bestellijn = $bestellingDao->createbestelLijn($bestellingId,$bestellijn["aantal"],$bestellijn["product"]);


		}

	}
}