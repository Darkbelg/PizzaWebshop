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
session_start();

if (isset($_SESSION["klant"]) && isset($_SESSION["winkelmandje"])) {
	$klantNummer = unserialize($_SESSION["klant"]);
	$sWinMand = unserialize($_SESSION["winkelmandje"]);

	$twigArray = array();
	$productSvc = new ProductService();
	foreach ($sWinMand as $product){
		$idP = $product["product"];
		$product["product"] = $productSvc->haalProductOp($idP);
		$sWinMand[$product["product"]->getId()] = $product;

	}
	$twigArray["winkelmandje"] = $sWinMand;
	$klantServ = new KlantService();
	print_r($klantNummer);
	$klant = $klantServ->getKlant($klantNummer);
	try{
		$klantServ->controleerRegio($klant->getStad()->getStad());
	}catch (BuitenLevergebiedException $ex){
		$twigArray["error"] = "Wij leveren niet in deze stad.";
	}
	$steden = $klantServ->toonLeverGebied();
	$twigArray["steden"]=$steden;
	$twigArray["klant"]= $klant;

	$view = $twig->render("afrekenen.twig", $twigArray);

} else {
	Doorverwijzen::doorverwijzen("aanmelden.php");
}
print ($view);