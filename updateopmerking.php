<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 2/05/2017
 * Time: 15:22
 */
require_once ('bootstrap.php');
require_once ('Business/KlantService.php');

if(isset($_POST["opmerking"])){
	$klantServ = new KlantService();
	$klantServ->updateOpmerking($_GET["id"], $_POST["opmerking"]);
	Doorverwijzen::doorverwijzen("beheerder.php?p=k");
	
}