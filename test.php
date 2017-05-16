<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:09
 */
require_once "Business/KlantService.php";
require_once "Exceptions/BestaatException.php";
require_once "Data/BestellingenDAO.php";
require_once "Business/BestelService.php";
require_once "Data/ProductDAO.php";
require_once "Business/ProductService.php";

$productDao = new BestellingenDAO();

try {
	$productDao->createExtra(14,3);
  print "<pre>";
	print_r("Wijzigen extra");
	print "</pre>";
}catch (BestaatException $ex){
	print("het bestaat al");
}