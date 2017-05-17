<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 18/04/2017
	 * Time: 11:06
	 */
	require_once("bootstrap.php");
	require_once "Business/KlantService.php";
	require_once "Exceptions/BuitenLevergebiedException.php";
	require_once "Business/BestelService.php";
	require_once "login.php";

	if(isset($_GET["action"])) {
		if($_GET["action"] == "toevoegen") {
			$stad       = $_POST["stad"];
			$straat     = $_POST["straat"];
			$huisnummer = $_POST["huisnummer"];
			$info       = $_POST["info"];

			$klantServ        = new KlantService();
			$bestellingenServ = new BestelService();
			$sWinMan          = unserialize($_SESSION["winkelmandje"]);
			$klantNummer      = $klant;
			$klant            = $klantServ->getById($klantNummer);
			$promoAanmerking  = $klantServ->setAanmerkingPromo($klantNummer);
			try {
				$klantServ->controleerRegio($stad);
			} catch(BuitenLevergebiedException $ex) {
				Doorverwijzen::doorverwijzen("afrekenen.php");
			}
			$tijd     = new DateTime($_POST["tijd"].$_POST["uur"]);
			$datum    = date_format($tijd, "y-m-d");
			$tijdstip = date_format($tijd, "H:i");

//			print_r($sWinMan);
//			foreach ($sWinMan as $item) {
//				if (isset($item["ingredienten"])) {
//					foreach ($item["ingredienten"] as $ing) {
//						print_r($ing);
//					}
//				}
//			}

		$bestelling = $bestellingenServ->nieuweBestelling($datum,$tijdstip,$klant->getKlantNummer(),$straat,$huisnummer,$stad,$sWinMan,$info);
		Doorverwijzen::doorverwijzen("toonallepizzas.php?succes=Uw bestelling is geplaatst.");

		}
	}