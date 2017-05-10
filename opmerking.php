<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 2/05/2017
 * Time: 15:04
 */

require_once ("bootstrap.php");
require_once ("Business/KlantService.php");

if(isset($_GET["id"])){
	$klantServ = new KlantService();
	$klant = $klantServ->getById($_GET["id"]);
	$twigarray["klant"] = $klant;
	$view = $twig->render('beheerder/klantopmerking.twig',$twigarray);
	print $view;
}