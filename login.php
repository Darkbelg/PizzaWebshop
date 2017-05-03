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
	$beheerder = $klantServ->isBeheerder(unserialize($_SESSION["klant"]));
	$klant = unserialize($_SESSION["klant"]);
	$twigarray["klant"]=$klant;
}