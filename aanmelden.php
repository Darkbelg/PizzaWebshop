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
	require_once ("login.php");

	if(isset($klant))Doorverwijzen::doorverwijzen('toonallepizzas.php');

	if (isset($_POST["email"]) && isset($_POST["wachtwoord"])) {
		try {
			$email = $_POST["email"];
			$wachtwoord = $_POST["wachtwoord"];
			$aanmeldServ = new AanmeldenService();
			$klant = $aanmeldServ->aanmelden($email, $wachtwoord);
			$_SESSION["klant"] = serialize($klant->getKlantNummer());
			if ($klant->getBeheerder() == 1) {
				$_SESSION["beheerder"] = 1;
			}
			setcookie("email", $klant->getEmailadres(), time() + (10 * 365 * 24 * 60 * 60));
			Doorverwijzen::doorverwijzen("afrekenen.php?succes=U bent succesvol ingelogd.");
		} catch (FouteLoginException $ex) {
			$twigarray["error"] = "Uw e-mail of wachtwoord is onjuist.";
			$view = $twig->render("aanmelden.twig",$twigarray);

		}

	}
	else {
		if (isset($_COOKIE["email"])) {
			$twigarray = array("email" => $_COOKIE["email"]);
			$view = $twig->render("aanmelden.twig");
		}
		else {
			$view = $twig->render("aanmelden.twig");
		}

	}


	print ($view);