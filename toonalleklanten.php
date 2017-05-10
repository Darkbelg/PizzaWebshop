<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 13:33
 */
require_once "Business/KlantService.php";
require_once "bootstrap.php";

$klantSvc =new KlantService();
$klanten = $klantSvc->getAll();
$view = $twig->render("beheerder/toonAlleKlanten.twig",array("klanten"=>$klanten));
print $view;