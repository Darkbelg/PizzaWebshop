<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 11:10
 */
//TODO
require_once ("bootstrap.php");
session_start();

if (isset($_SESSION["klant"])&&isset($_SESSION["winkelmandje"])){
	$klant = unserialize($_SESSION["klant"]);
	$sWinMand = unserialize($_SESSION["winkelmandje"]);
    print_r($klant);
	print_r($sWinMand);
	$view = $twig->render("afrekenen.twig",array("winkelmandje"=>$sWinMand));

}else{
Doorverwijzen::doorverwijzen("aanmelden.php");
}
print ($view);