<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 19/04/2017
 * Time: 14:57
 */
require_once("bootstrap.php");
require_once("Business/ProductService.php");


if (isset($_GET["action"])) {
	$productServ = new ProductService();
	if ($_GET["action"] == "toevoegen") {

		if (isset($_GET["extra"]) && $_GET["extra"] == "nee") {
			$twigarray["extra"] = 0;

			//$productServ->voegNieuwPizzaToe();
		}
		elseif (isset($_GET["extra"]) && $_GET["extra"] == "ja") {
			$twigarray["extra"] = 1;

			//$productServ->voegNieuweExtraToe();
		}

		if (isset($_POST["extra"])) {

			if ($_POST["extra"] == "ja") {
				$productServ->voegNieuweExtraToe($_POST["naam"], $_POST["prijs"], $_POST["beginDatum"], $_POST["eindDatum"], $_POST["omschrijving"]);


			}
			else {
				$productServ->voegNieuwPizzaToe($_POST["naam"], $_POST["prijs"], $_POST["beginDatum"], $_POST["eindDatum"], $_POST["omschrijving"]);

			}
			Doorverwijzen::doorverwijzen('beheerder.php?p=p');
		}

		$view = $twig->render('beheerder/producttoevoegen.twig', $twigarray);
		print $view;
	}
	if ($_GET["action"] == "bewerken") {

	}
	if ($_GET["action"] == "verwijder") {
		$productServ->verwijder($_GET["id"]);
		Doorverwijzen::doorverwijzen("beheerder.php?p=p");
	}

}