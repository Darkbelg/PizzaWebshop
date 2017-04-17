<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:09
 */
require_once "Business/ProductService.php";
require_once "bootstrap.php";

session_start();

$twigarray = array();
if (isset($_SESSION["winkelmandje"])){
	$winkelmandje = unserialize($_SESSION["winkelmandje"]);
	print_r($winkelmandje);
	$twigarray["winkelmandje"] = $winkelmandje;

}else{

}
$productenSvc = new ProductService();
$producten = $productenSvc->toonProducten();
$twigarray["producten"]=$producten;
$view = $twig->render("toonAllePizzas.twig",$twigarray);
print $view;