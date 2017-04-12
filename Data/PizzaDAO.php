<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:53
 */
require_once "DBConfig.php";
require_once "Entities/Pizza.php";
require_once "Data/IngredientenDAO.php";

class PizzaDAO
{
	public function getAll()
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from pizza";
		$resultSet=$dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij){
			$ingredienten = $this->getIngredientenFromPizzaId($rij["pizzaId"]);

			$pizza = Pizza::create($rij["pizzaId"],$rij["naam"],$rij["prijs"],$rij["beginDatum"],$rij["eindDatum"],$rij["promoKorting"],$rij["omschrijving"],$ingredienten);

			array_push($lijst,$pizza);
		}
		$dbh=DBConfig::sluitConnectie();
		return $lijst;
}
	private function getIngredientenFromPizzaId($id)
	{
		$dbh=DBConfig::openConnectie();
		$sql = "SELECT i.ingredientenId,i.naam,i.voedingswaarden,i.kostprijs,i.extra
FROM ingredienten as i INNER JOIN samenstelling on i.ingredientenId = samenstelling.ingredientId 
INNER JOIN pizza on samenstelling.pizzaId = pizza.pizzaId
WHERE pizza.pizzaId = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$lijst = array();
		foreach ($stmt as $rij){
			$ingredient = Ingredient::create($rij["ingredientenId"],$rij["naam"],$rij["voedingswaarden"],$rij["kostprijs"],$rij["extra"]);
			array_push($lijst,$ingredient);
		}
		$dbh=DBConfig::sluitConnectie();
		return $lijst;

	}

	public function getPizzaById($id){
		$dbh=DBConfig::openConnectie();
		$sql = "select * from pizza WHERE pizzaId = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$ingredienten = $this->getIngredientenFromPizzaId($id);
		$pizza = Pizza::create($rij["pizzaId"],$rij["naam"],$rij["prijs"],$rij["beginDatum"],$rij["eindDatum"],$rij["promoKorting"],$rij["omschrijving"],$ingredienten);
		$dbh = DBConfig::sluitConnectie();
		return $pizza;
	}
}