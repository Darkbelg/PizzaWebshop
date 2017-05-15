<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:09
 */

require_once "Business/ProductService.php";
require_once "bootstrap.php";
require_once "login.php";

$productenSvc = new ProductService();
$producten = $productenSvc->getAllByToday();
$twigarray["producten"]=$producten;

if(isset($_GET["b"])&& $_GET["b"]=="s"){
	$twigarray["bestelling"] = "Uw besteling is besteld.";
	unset($_SESSION["winkelmandje"]);

}
if (isset($_SESSION["winkelmandje"])){
	$winkelmandje = unserialize($_SESSION["winkelmandje"]);
	foreach ($winkelmandje as $product){
		$idP= $product["product"];
		$product["product"] = $productenSvc->getById($idP);
		$winkelmandje[$idP] = $product;
	}
	$twigarray["winkelmandje"] = $winkelmandje;
}

if (isset($promo)){
	$twigarray["promo"] = 1;
}

$view = $twig->render("toonallepizzas.twig",$twigarray);
print $view;