<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 13/04/2017
	 * Time: 11:10
	 */

	require_once("bootstrap.php");
	require_once("Business/ProductService.php");
	require_once("Business/KlantService.php");
	require_once("login.php");

	if(isset($_GET["succes"])) {
		$twigArray["succes"] = $_GET["succes"];
	}

	if($klant) {
		if(isset($_SESSION["winkelmandje"])) {
			$klantNummer = $klant;
			$sWinMand    = unserialize($_SESSION["winkelmandje"]);
			$productSvc = new ProductService();
			$klantServ  = new KlantService();

//		foreach ($sWinMand as $product) {
//			$idP = $product["product"];
//			$product["product"] = $productSvc->getById($idP);
//			$sWinMand[$product["product"]->getId()] = $product;
//
//		}
//
//
			$twigArray["winkelmandje"] = $productSvc->winkelmandje($sWinMand);
			$klant = $klantServ->getById($klantNummer);

			try {
				$klantServ->controleerRegio($klant->getStad()->getStad());
			} catch(BuitenLevergebiedException $ex) {
				$twigArray["error"]     = "Wij leveren niet in deze stad.";
				$twigArray["leverStad"] = $klantServ->toonLeverGebied();
			}
			$steden              = $klantServ->toonLeverGebied();
			$twigArray["steden"] = $steden;
			$twigArray["klant"]  = $klant;
			if(isset($promo)) {
				$twigArray["promo"] = $promo;
			}

			$vandaag              = new DateTime('now');
			$twigArray["vandaag"] = $vandaag->format("Y-m-d");
			$twigArray["tijd"]    = $vandaag->format("H:i");
			$view                 = $twig->render("afrekenen.twig", $twigArray);
		}
		else {
			if(isset($_GET["succes"])) Doorverwijzen::doorverwijzen("toonallepizzas.php?succes=" . $_GET["succes"]);
			else Doorverwijzen::doorverwijzen("toonallepizzas.php");
		}
	}
	else {
		Doorverwijzen::doorverwijzen("aanmeldkeuze.php");
	}
	print ($view);