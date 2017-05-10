<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 19/04/2017
 * Time: 14:57
 */
require_once("bootstrap.php");
require_once("Business/ProductService.php");
require_once ("login.php");


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
		//print_r($_POST);
		if (isset($_POST["extra"])) {
			if ($_POST["extra"] == "ja") {
				try {
					$productServ->voegNieuweExtraToe($_POST["naam"], $_POST["prijs"], $_POST["beginDatum"], $_POST["eindDatum"], $_POST["promoKorting"], $_POST["omschrijving"]);
				} catch (BestaatException $ex) {
					$error = "&error=Extra ".  $_POST["naam"] ." bestaat all!";
				}
				Doorverwijzen::doorverwijzen('beheerder.php?p=p'.$error);
			}

		}
		if (!isset($_POST["extra"]) && isset($_POST["naam"])) {
			try {
				$productServ->voegNieuwPizzaToe($_POST["naam"], $_POST["prijs"], $_POST["beginDatum"], $_POST["eindDatum"], $_POST["promoKorting"], $_POST["omschrijving"]);
			} catch (BestaatException $ex) {
				$error = "&error=Pizza ".  $_POST["naam"] ." bestaat all!";
			}
			Doorverwijzen::doorverwijzen('beheerder.php?p=p'.$error);
		}
		$view = $twig->render('beheerder/producttoevoegen.twig', $twigarray);
		print $view;
	}
	if ($_GET["action"] == "wijzigen") {
		if(isset($_GET["error"])){
			$twigarray["error"] = $_GET["error"];
		}
		$product = $productServ->getById($_GET["id"]);
		$twigarray["product"] = $product;
		//print_r($product);
		$view = $twig->render('beheerder/productwijzigen.twig',$twigarray);
		print $view;
	}
	if ($_GET["action"]=="bewerken"){
		try{
			if($_POST["extra"] == "ja" ){
				$extra = 1;
			}else{
				$extra = 0;
			}

			$productServ->update($_GET["id"], $_POST["naam"], $_POST["prijs"], $_POST["beginDatum"], $_POST["eindDatum"], $_POST["promoKorting"], $_POST["omschrijving"], $extra);
			Doorverwijzen::doorverwijzen("beheerder.php?p=p");
		}catch (BestaatException $ex){
//			$twigarray["error"] = "U kunt deze naam niet gebruiken het product bestaat al.";
			Doorverwijzen::doorverwijzen("product.php?action=wijzigen&id=". $_GET["id"] ."&error=U kunt deze naam niet gebruiken product bestaat al.");
//			$view = $twig->render('beheerder/productwijzigen.twig',$twigarray);
//			print $view;
		}
	}
	if ($_GET["action"] == "verwijder") {
		$productServ->verwijder($_GET["id"]);
		Doorverwijzen::doorverwijzen("beheerder.php?p=p");
	}

}