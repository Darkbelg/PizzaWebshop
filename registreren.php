<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 13/04/2017
	 * Time: 11:42
	 */
	require_once("bootstrap.php");
	require_once("Business/KlantService.php");
	session_start();
	if(isset($_GET["action"])) {
		if($_GET["action"] == "registreren" | $_GET["action"] == "registreeraccount") {

			if((isset($_POST["action"]) && $_POST["action"] == "registreren") | $_GET["action"] == "registreeraccount") {
				$twigarray = array("account" => true);
				$view      = $twig->render("registreren.twig", $twigarray);
			}
			else {
				$view = $twig->render("registreren.twig");
			}
			print $view;
		}
		if($_GET["action"] == "process") {
			if(isset($_POST["naam"])) {

				$klantServ = new KlantService();
				$klant     = $klantServ->create($_POST);
				if(isset($_POST["email"])) {
					$klant = $klantServ->registreerAccount($_POST["email"], $_POST["wachtwoord"], $klant->getKlantnummer());
				}
				$_SESSION["klant"] = serialize($klant->getKlantnummer());
				setcookie("email", $klant->getEmailadres(), time() + (10 * 365 * 24 * 60 * 60));
				Doorverwijzen::doorverwijzen("afrekenen.php?succes=U bent succesvol geregistreerd.");

			}
			else {
				echo "Er is iets fout gelopen.";
			}

		}
	}
	else {
		Doorverwijzen::doorverwijzen("aanmelden.php");
	}