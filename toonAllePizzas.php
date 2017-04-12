<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:09
 */
require_once "Business/PizzaService.php";
require_once "bootstrap.php";

$pizzaSvc = new PizzaService();
$pizzas = $pizzaSvc->toonPizzas();
$view = $twig->render("toonAllePizzas.twig",array("pizzas"=>$pizzas));
print $view;