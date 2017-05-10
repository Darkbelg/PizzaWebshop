<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:19
 */

require_once "Business/ZaakService.php";
require_once("bootstrap.php");

$zaakSvc = new ZaakService();
$zaak = $zaakSvc->getByNaam("Papi Product");
//print_r($zaak);

//include "Presentation/index.php";
$view = $twig->render("index.twig",array("zaak"=>$zaak));
print($view);