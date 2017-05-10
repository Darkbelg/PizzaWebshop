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

$productServ = new ProductService();

try {
	$productServ->update("7","champignon","0.70","2017-5-2","2017-5-5","0.1","De lekkerste paddestoel die er is.","1");
  print "<pre>";
	print_r("Wijzigen extra");
	print "</pre>";
}catch (BestaatException $ex){
	print("het bestaat al");
}