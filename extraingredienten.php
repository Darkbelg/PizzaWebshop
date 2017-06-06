<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 15/05/2017
	 * Time: 14:57
	 */
	require_once("bootstrap.php");
	require_once("Business/ProductService.php");
	require_once("login.php");
	$productServ = new ProductService();
	$product = $productServ->getById($_GET["id"]);
	$twigarray["pizza"] = $product;
	$extras = $productServ->getAllByToday();
	$twigarray["extras"] = $extras;
	$view = $twig->render("extraingredienten.twig",$twigarray);
	print ($view);