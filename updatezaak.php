<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 17/05/2017
	 * Time: 10:50
	 */
	require_once("bootstrap.php");
	require_once ("Business/ZaakService.php");
	require_once ("Exceptions/NotADateException.php");
	require_once ("Exceptions/NotANumberException.php");

if($_GET["id"]){
	$id = $_GET["id"];
	$beginDatum = $_POST["beginDatum"];
	$eindDatum = $_POST["eindDatum"];
	$aantal = $_POST["aantal"];
	$voorwaarden = $_POST["voorwaarden"];
	$zaakSer = new ZaakService();


	try{
		$zaakSer->update($id,$beginDatum,$eindDatum,$aantal,$voorwaarden);
		$succes = "&succes=Gegevens bijgewerkt";
	}catch(Exception $ex){
		print $ex->getMessage();
		$error = "&error=".$ex->getMessage();

		//$error = "Voer een correcte datum in.";

	}
	Doorverwijzen::doorverwijzen("beheerder.php?p=a".$error.$succes);


}