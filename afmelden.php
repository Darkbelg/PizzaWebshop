<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 3/05/2017
 * Time: 14:31
 */
require_once "bootstrap.php";

session_start();

if (isset($_SESSION["klant"])) {
		unset($_SESSION["klant"]);
		unset($_SESSION["winkelmandje"]);
		Doorverwijzen::doorverwijzen("toonallepizzas.php");

}