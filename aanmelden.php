<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 11:14
 */

require_once("bootstrap.php");
require_once("Business/AanmeldenService.php");
require_once("Exceptions/FouteLoginException.php");
session_start();

if (isset($_SESSION["klant"])) {
	echo "U bent aangemeld";
	Doorverwijzen::doorverwijzen("toonallepizzas.php");
}

if (isset($_GET["action"]) && $_GET["action"] == "aanmelden") {
	if (isset($_POST["email"]) && isset($_POST["wachtwoord"])) {
		try {
			$email = $_POST["email"];
			$wachtwoord = $_POST["wachtwoord"];
			$aanmeldServ = new AanmeldenService();
			$klant = $aanmeldServ->aanmelden($email, $wachtwoord);
			$_SESSION["klant"] = serialize($klant->getKlantNummer());
			//$_COOKIE["email"] = $klant->getEmailadres();
			setcookie("email", $klant->getEmailadres(), time() + 3600);
			Doorverwijzen::doorverwijzen("afrekenen.php");
		} catch (FouteLoginException $ex) {
			$view = $twig->render("aanmelden.twig");
			echo "Foutte inloggegevens";
		}

	} else {
		if (isset($_COOKIE["email"])) {
			$twigarray = array("email"=> $_COOKIE["email"]);
			$view = $twig->render("aanmelden.twig", $twigarray);
		} else {
			$view = $twig->render("aanmelden.twig");
		}

	}
} else {
	$view = $twig->render("aanmeldkeuze.twig");
}

print ($view);