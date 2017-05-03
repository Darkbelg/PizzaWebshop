<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 11:10
 */


require_once("bootstrap.php");
require_once ("Business/ProductService.php");
require_once ("Business/KlantService.php");
require_once ("login.php");

if ($klant) {
	if(isset($_SESSION["winkelmandje"])) {
		$klantNummer = unserialize($_SESSION["klant"]);
		$sWinMand = unserialize($_SESSION["winkelmandje"]);

		$twigArray = array();
		$productSvc = new ProductService();
		foreach ($sWinMand as $product) {
			$idP = $product["product"];
			$product["product"] = $productSvc->getById($idP);
			$sWinMand[$product["product"]->getId()] = $product;

		}
		$twigArray["winkelmandje"] = $sWinMand;
		$klantServ = new KlantService();
		$klant = $klantServ->getById($klantNummer);
		try {
			$klantServ->controleerRegio($klant->getStad()->getStad());
		} catch (BuitenLevergebiedException $ex) {
			$twigArray["error"] = "Wij leveren niet in deze stad.";
			$twigArray["leverStad"] = $klantServ->toonLeverGebied();
		}
		$steden = $klantServ->toonLeverGebied();
		$twigArray["steden"] = $steden;
		$twigArray["klant"] = $klant;

		$view = $twig->render("afrekenen.twig", $twigArray);
	}
	else{
		Doorverwijzen::doorverwijzen("toonallepizzas.php");
	}
} else {
	Doorverwijzen::doorverwijzen("aanmeldkeuze.php");
}
print ($view);