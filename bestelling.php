<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 18/04/2017
 * Time: 11:06
 */
require_once ("bootstrap.php");
require_once "Business/KlantService.php";
require_once "Exceptions/BuitenLevergebiedException.php";
require_once "Business/BestelService.php";

session_start();

if (isset($_GET["action"])){
	if ($_GET["action"] == "toevoegen"){
		$stad = $_POST["stad"];
		$straat = $_POST["straat"];
		$huisnummer = $_POST["huisnummer"];

		$klantServ = new KlantService();
		$bestellingenServ = new BestelService();
		$sWinMan = unserialize($_SESSION["winkelmandje"]);
		$klantNummer = unserialize($_SESSION["klant"]);

		$klant = $klantServ->getKlant($klantNummer);
		try{
			$klantServ->controleerRegio($stad);
		}catch (BuitenLevergebiedException $ex){
			Doorverwijzen::doorverwijzen("afrekenen.php");
		}
		$tijd = new DateTime($_POST["tijd"]);
		$datum = date_format($tijd, "y-m-d");
		$tijdstip =date_format($tijd, "H:i:s");
		$bestelling = $bestellingenServ->nieuweBestelling($datum,$tijdstip,$klant->getKlantNummer(),$straat,$huisnummer,$stad,$sWinMan);
		Doorverwijzen::doorverwijzen("toonallepizzas.php?b=s");


	}
}