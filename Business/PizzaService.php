<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 9:38
 */
require_once "Data/PizzaDAO.php";
require_once "Data/IngredientenDAO.php";
class PizzaService
{
	public function toonPizzas()
	{
		$pizzaDAO = new PizzaDAO();

		$pizzas = $pizzaDAO->getAll();

		return $pizzas;

	}



}