<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:09
 */
require_once "Business/ProductService.php";
require_once "bootstrap.php";

$productenSvc = new ProductService();
$producten = $productenSvc->toonProducten();
$view = $twig->render("toonAlleExtras.twig",array("producten"=>$producten));
print $view;