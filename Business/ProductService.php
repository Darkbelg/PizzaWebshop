<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 9:38
 */
require_once "Data/ProductDAO.php";

class ProductService
{
	public function toonProducten()
	{
		$productDAO = new ProductDAO();
		$product = $productDAO->getAll();
		return $product;
	}

	public function haalProductOp($id)
	{
		$productDAO = new ProductDAO();
		$product = $productDAO->getProductById($id);
		return $product;
	}

	public function voegNieuwPizzaToe($naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving)
	{
		$pizzaDAO = new ProductDAO();
		$pizzaDAO->create($naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving, 0);
	}

	public function voegNieuweExtraToe($naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving)
	{
		$extraDAO = new ProductDAO();
		$extraDAO->create($naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving, 1);
	}

	public function verwijderProduct($id)
	{
		$productDAO = new ProductDAO();
		$productDAO->delete($id);
	}

	public function update($id, $naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving, $extra)
	{
		$productDAO = new ProductDAO();
		$product = $productDAO->getProductById($id);
		$product->setNaam($naam);
		$product->setPrijs($prijs);
		$product->setBeginDatum($beginDatum);
		$product->setEindDatum($eindDatum);
		$product->setPromoKorting($promoKorting);
		$product->setOmschrijving($omschrijving);
		$product->setExtra($extra);
		$productDAO->update($product);
	}


}