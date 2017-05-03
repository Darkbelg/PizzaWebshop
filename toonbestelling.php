<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 3/05/2017
 * Time: 10:42
 */
require_once ("bootstrap.php");
require_once ("Business/BestelService.php");
require_once ("Business/KlantService.php");
require_once ("Business/ProductService.php");

session_start();
if (isset($_GET["id"])&& $_GET["id"] != "" ){
	$id = $_GET["id"];
	$bestelServ = new BestelService();
	$bestellijnen = $bestelServ->getBestellijnenById($id);

	//Ik heb de klant van de bestelling nodig.
	//de pizza(product) om de naam weer te geven en misscien de kost
	//Ik heb de bestelling nodig voor meer info over de klant,info,datum,tijdstip,straat,stad

	$bestelling = $bestelServ->getBestellingById($bestellijnen[0]->getBestellingId());

	$pizzaServ = new ProductService();
	foreach ($bestellijnen as $item) {
		$pizza = $pizzaServ->getById($item->getPizzaId());

		$item->setPizzaId($pizza);
	}
	//print_r($bestelling);
	$twigarray["bestelling"] = $bestelling;
	$twigarray["bestellijnen"]  = $bestellijnen;

	//print_r($bestellijnen);
	$view = $twig->render('beheerder/bestellijnen.twig',$twigarray);
	print ($view);
}else{
	Doorverwijzen::doorverwijzen("beheerder.php?p=b");
}
