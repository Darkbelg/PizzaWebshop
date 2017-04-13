<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 11:42
 */
require_once("bootstrap.php");
require_once ("klantService.php");
session_start();
if (isset($_GET["action"]) && $_GET["action"] == "registreren") {
	if (isset($_POST["action"]) && $_POST["action"] == "registreren") {
		$twigarray = array("account" => true);
		$view = $twig->render("registreren.twig", $twigarray);
	} else {
		$view = $twig->render("registreren.twig");
	}
	if(isset($_POST["naam"])){
		$klantServ = new KlantService();
		$klant = $klantServ->registreerKlant($_POST);
	}

	print $view;
}
else
{
	Doorverwijzen::doorverwijzen("aanmelden.php");
}
