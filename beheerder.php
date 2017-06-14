<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 19/04/2017
	 * Time: 13:11
	 */
	require_once("bootstrap.php");
	require_once("Business/KlantService.php");
	require_once("Business/ProductService.php");
	require_once("Business/BestelService.php");
	require_once("Business/ZaakService.php");
	require_once("login.php");

	if(isset($_GET["error"])) {
		$twigarray["error"] = $_GET["error"];
	}
	if(isset($_GET["succes"])) {
		$twigarray["succes"] = $_GET["succes"];
	}

//if (isset($_SESSION["klant"])) {
//	$klantServ = new KlantService();
//	$beheerder = $klantServ->isBeheerder(unserialize($_SESSION["klant"]));
//	$twigarray["klant"]=unserialize($_SESSION["klant"]);
//}
	if(isset($beheerder) && $beheerder) {
		if(isset($_GET["p"])) {

			//welke bestellingen renderen
			if($_GET["p"] == "b") {
				$bestelServ                = new BestelService();
				$twigarray["bestellingen"] = $bestelServ->getAll();
				$vandaag                   = new DateTime("now");
				$twigarray["vandaag"]      = $vandaag->format("Y-m-d");
				$view                      = $twig->render('beheerder/bestellingen.twig', $twigarray);
			}
			//Welke product pagina renderen
			if($_GET["p"] == "p") {
				$productServ            = new ProductService();
				$twigarray["producten"] = $productServ->getAll();
				$view                   = $twig->render('beheerder/producten.twig', $twigarray);
			}
			// Welke klant pagina renderen
			if($_GET["p"] == "k") {
				$twigarray["leverGebied"] = $klantServ->toonLeverGebied();
				$twigarray["klanten"]     = $klantServ->getAll();
				$view                     = $twig->render('beheerder/producten.twig', $twigarray);
			}
			if($_GET["p"] == "a") {
				$zaakService       = new ZaakService();
				$zaak              = $zaakService->getByNaam("Papi Pizza");
				$twigarray["zaak"] = $zaak;
				$view              = $twig->render('beheerder/andere.twig', $twigarray);
			}
			print $view;
		}
	}
	else {
		Doorverwijzen::doorverwijzen('aanmelden.php');
	}



