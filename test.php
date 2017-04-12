<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:09
 */
require_once "Business/ZaakService.php";
require_once "Data/PizzaDAO.php";
require_once "Business/PizzaService.php";
require_once "Data/KlantDAO.php";

$klantDAO = new KlantDAO();
$klanten = $klantDAO->getKlanten();
print "<pre>";
print_r($klanten);
print "</pre>";