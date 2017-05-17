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
	$lijst = $productDao->getExtra(13);
  print "<pre>";
	print_r($lijst);
	print "</pre>";
}catch (BestaatException $ex){
	print("het bestaat al");
}