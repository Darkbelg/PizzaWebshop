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

if (isset($_SESSION["klant"])){
	$klant = $_SESSION["klant"];
	$view = $twig->render("afrekenen.twig");
}else{
Doorverwijzen::doorverwijzen("aanmelden.php");
}
print ($view);