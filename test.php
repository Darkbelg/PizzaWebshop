<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:09
 */
require_once "Data/StadDAO.php";
require_once "Entities/Stad.php";


try {
	$productDAO = new ProductDAO();

	$productDAO->update("4");
	$pizza = $productDAO->getProductById();
	print "<pre>";
	print_r($steden);
	print "</pre>";
}catch (BestaatException $ex){
	print("het bestaat al");
}