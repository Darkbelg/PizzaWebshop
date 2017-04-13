<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 12/04/2017
 * Time: 15:05
 */
require_once ("bootstrap.php");
require_once ("Business/ProductService.php");

if(isset($_GET["action"])&& ($_GET["action"]=="process")){
	try{
		$productSvc = new ProductService();
		$productSvc->update($_GET["id"], $_POST["txtNaam"], $_POST["txtPrijs"], $_POST["txtBeginDatum"], $_POST["txtEindDatum"], $_POST["txtPromoKorting"], $_POST["txtOmschrijving"]);
		$product= $productSvc->haalProductOp($_GET["id"]);
		if($product->getExtra()==1) {
			header("location:toonalleextras.php");
			exit(0);
		}else{
			header("location:toonallepizzas.php");
			exit(0);
		}
		}catch(BestaatException $ex){
		header("location:updateproduct.php?id=" . $_GET["id"] . "&error=productbestaat");
		exit(0);
	}
}else {

	$productSvc = new ProductService();
	$product = $productSvc->haalProductOp($_GET["id"]);
	$twigArray = array("product"=>$product);
	if (isset($_GET["error"])) {
		$error = $_GET["error"];
		$twigArray["error"] = $error;
	}

	$view = $twig->render("updateProduct.twig",$twigArray);
	print ($view);
}