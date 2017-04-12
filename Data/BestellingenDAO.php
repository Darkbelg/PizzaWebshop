<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 15:20
 */
require_once "DBConfig.php";
require_once "Entities/Bestellingen.php";
require_once "Entities/Bestelling.php";
require_once "Entities/Pizza.php";
require_once "Entities/Ingredienten.php";

class BestellingenDAO
{
	public function getAllOrders()
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from bestellingen";
		$resultSet = $dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij) {
			$bestelling = $this->getOrdersById($rij["bestellingId"]);
			$bestellingen = Bestellingen::create($rij["bestellingId"],$rij["datum"],$rij["tijdstip"],$rij["info"])
			//$order=Bestellingen::create();
		}

	}
	private function  getOrdersById($id){
		$dbh = DBConfig::openConnectie();
		$sql = "select * from bestelling WHERE bestellingId = :id";
		$stmt=$dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$lijst = array();
		foreach ($stmt as $rij){
			$ingredienten = $this->getOrdersExtraPizzaId($rij["orderId"]);
			$pizzaDAO = new PizzaDAO();
			$pizza = $pizzaDAO->getPizzaById($rij["pizzaId"]);
			$bestelling = Bestelling::create($rij["orderId"],$rij["bestellingId"],$rij["aantal"],$pizza,$ingredienten);
			array_push($lijst,$bestelling);
		}
		$dbh = DBConfig::sluitConnectie();
		return $lijst;
		
	}

	private function getOrdersExtraPizzaId($orderId)
	{
		$dbh=DBConfig::openConnectie();
		$sql = "SELECT ingredientenId,naam,voedingswaarden,kostprijs,extra FROM bestelling INNER JOIN extraingredienten on bestelling.orderId = extraingredienten.orderId INNER JOIN ingredienten on extraingredienten.ingredientId = ingredienten.ingredientenId where extraingredienten.orderId = :order";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array('order'=>$orderId));
		$lijst = array();
		foreach ($stmt as $rij){
			$ingredient = Ingredient::create($rij["ingredientenId"],$rij["naam"],$rij["voedingswaarden"],$rij["kostprijs"],$rij["extra"] );
			array_push($lijst,$ingredient);
		}
		return $lijst;

	}
}