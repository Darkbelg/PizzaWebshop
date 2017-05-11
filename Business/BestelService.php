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
	require_once "Data/KlantDAO.php";



	class BestelService
	{
		public function nieuweBestelling($datum, $tijdstip, $klantNummer, $straat, $huisnummer, $stad, $bestellijnen, $info)
		{
			$bestellingDao = new BestellingenDAO();
			$straatDao = new StraatDAO();
			$stadDao = new StadDAO();
			try {
				$straat = $straatDao->create($straat, $huisnummer);
			} catch (StraatBestaatException $ex) {
				$straat = $straatDao->getByStraat($straat, $huisnummer);
			}
			$stad = $stadDao->getByNaam($stad);
			$bestellingen = $bestellingDao->create($datum, $tijdstip, $klantNummer, $straat->getId(), $stad->getId(), $info);


			$this->nieuwBestellijn($bestellijnen, $bestellingen->getId());

			return $bestellingen;

		}

		public function nieuwBestellijn($bestellijnen, $bestellingId)
		{
			$bestellingDao = new BestellingenDAO();

			foreach ($bestellijnen as $bestellijn) {
				$bestellijn = $bestellingDao->createbestelLijn($bestellingId, $bestellijn["aantal"], $bestellijn["product"]);
			}

		}

		public function getAll()
		{
			$bestelDao = new BestellingenDAO();
			return $bestelDao->getAllOrders();
		}

		public function getBestellijnenById($id)
		{
			$bestellijnDao = new BestellingenDAO();
			$bestellijnen = $bestellijnDao->getBestellijnen($id);
			return $bestellijnen;
		}

		public function getBestellingById($bestellingId)
		{
			//Ophalen Klant
			//Ophalen Straat
			//Ophalen Stad

			$bestellingenDao = new BestellingenDAO();
			$bestelling = $bestellingenDao->getById($bestellingId);
			//print_r($bestelling);
			$klantDao = new KlantDAO();
			$klant = $klantDao->getById($bestelling->getKlant());
			//print_r($klant);
			$bestelling->setKlant($klant);
			$straat = StraatDAO::getById($bestelling->getStraat());
			$bestelling->setStraat($straat);
			$stadDao = new StadDAO();
			$stad = $stadDao->getById($bestelling->getPlaats());
			$bestelling->setPlaats($stad);
			return $bestelling;
		}
	}