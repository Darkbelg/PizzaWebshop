<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 3/05/2017
 * Time: 14:27
 */
require_once "Business/KlantService.php";

session_start();

//altijd als laatste require_once omdat deze de session_start().
if (isset($_SESSION["klant"])) {
	$klantServ = new KlantService();
	$klant = unserialize($_SESSION["klant"]);
	$k = $klantServ->getById($klant);
	$beheerder = $k->getBeheerder();
	$promo = $k->getPromo();
	$promo = $klantServ->getInPromoPeriode();
	$twigarray["klant"]=$klant;
}