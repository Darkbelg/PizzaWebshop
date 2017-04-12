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
	$stadDAO = new StadDAO();

	$stadDAO->delete("4");
	$stadDAO->create("Tilt","8700");
	$steden = $stadDAO->getAlleSteden();
	print "<pre>";
	print_r($steden);
	print "</pre>";
}catch (BestaatException $ex){
	print("het bestaat al");
}