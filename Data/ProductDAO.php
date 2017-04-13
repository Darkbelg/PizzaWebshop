<?php
// TODO CRUD
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:53
 */
require_once "DBConfig.php";
require_once "Entities/Product.php";

class ProductDAO
{
	public function getAll()
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from product";
		$resultSet=$dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij){

			$product= Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["beginDatum"], $rij["eindDatum"], $rij["promoKorting"], $rij["omschrijving"],$rij["extra"]);
			array_push($lijst,$product);
		}
		$dbh=DBConfig::sluitConnectie();
		return $lijst;
}


	public function getProductById($id){
		$dbh=DBConfig::openConnectie();
		$sql = "select * from product WHERE id = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$product = Product::create($rij["id"], $rij["naam"], $rij["prijs"], $rij["beginDatum"], $rij["eindDatum"], $rij["promoKorting"], $rij["omschrijving"], $rij["extra"]);
		$dbh = DBConfig::sluitConnectie();
		return $product;
	}

	public function create($naam,$prijs,$beginDatum,$eindDatum,$promoKorting,$omschrijving,$extra)
	{

		if(is_null($naam)){
			throw new NaamLeegException();
		}
		if (is_null($prijs)){
			throw new PrijsLeegException();
		}
		$dbh = DBConfig::openConnectie();
		$sql = "insert into product(naam, prijs, beginDatum, eindDatum, promoKorting, omschrijving, extra) VALUES (naam=:naam,prijs=:prijs,beginDatum=:beginDatum,eindDatum=:eindDatum,promoKorting=:promoKorting,omschrijving=:omschrijving,extra:=extra)";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':naam'=>$naam,':prijs'=>$prijs,':beginDatum'=>$beginDatum,':eindDatum'=>$eindDatum,':promoKorting'=>$promoKorting,':omschrijving'=>$omschrijving,':extra'=>$extra));
		$dbh = DBConfig::sluitConnectie();
	}

	public function delete($id)
	{
		$dbh = DBConfig::openConnectie();
		$sql = "delete from product WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$dbh = DBConfig::sluitConnectie();
	}

	public function update($product)
	{
		$bestaatProduct = $this->getProductById($product->getId());
		if(!is_null($bestaatProduct)&&($bestaatProduct->getId()!=$product->getId())){
			throw new BestaatException();
		}
		$dbh = DBConfig::openConnectie();
		$sql = "update product set naam=:naam,prijs=:prijs,beginDatum=:beginDatum,eindDatum=:eindDatum,promoKorting=:promoKorting,omschrijving=:omschrijving,extra=:extra where id =:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':naam'=>$product->getNaam(),':prijs'=>$product->getPrijs(),':beginDatum'=>$product->getBeginDatum(),':eindDatum'=>$product->getEindDatum(),':promoKorting'=>$product->getPromoKorting(),':omschrijving'=>$product->getOmschrijving(),':extra'=>$product->getExtra(),':id'=>$product->getId()));
		$dbh = DBConfig::sluitConnectie();
	}
}