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
require_once ("login.php");

if (isset($_GET["id"])&& $_GET["id"] != "" ){
	//id ophalen van de bestelling
	$id = $_GET["id"];
	//een nieuwe bestelservice aanmaken
	$bestelServ = new BestelService();
	//de bestellijnen per bestelling opvragen.
	$bestellijnen = $bestelServ->getBestellijnenById($id);
//	print_r($bestellijnen);


	//Ik heb de klant van de bestelling nodig.
	//de pizza(product) om de naam weer te geven en misscien de kost
	//Ik heb de bestelling nodig voor meer info over de klant,info,datum,tijdstip,straat,stad

	//haalt de bestelling op
	$bestelling = $bestelServ->getBestellingById($bestellijnen[0]->getBestellingId());
	//een nieuwe productservices voor de pizzas op te halen
	$pizzaServ = new ProductService();



	//voor elk item van bestellijnen
	$b = array();
	foreach ($bestellijnen as $item) {
		$pizza = $pizzaServ->getById($item->getPizzaId());
		$item->setPizzaId($pizza);


		$obj = new stdClass();
		$obj->product = $item;
		$obj->ingredienten = $bestelServ->getExtra($item->getId());
		array_push($b,$obj);
	}
	//print_r($bestelling);
	$twigarray["bestelling"] = $bestelling;
	$twigarray["bestellijnen"]  = $b;

	//print_r($bestellijnen);
	$view = $twig->render('beheerder/bestellijnen.twig',$twigarray);
	print ($view);
}else{
	Doorverwijzen::doorverwijzen("beheerder.php?p=b");
}
