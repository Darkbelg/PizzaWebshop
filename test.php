<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:09
 */
require_once "Business/KlantService.php";
require_once "Exceptions/BestaatException.php";
require_once "Data/BestellingenDAO.php";
require_once "Business/BestelService.php";



try {
	$bestellingenServ = new BestelService();
	$winkelmandje = array(array("aantal"=>"1","productId"=>"1"),array("aantal"=>"2","productId"=>"4"));

	$bestelling = $bestellingenServ->nieuweBestelling("2017-04-18","15:45:00","3","cornationStreet","36","Tielt",$winkelmandje);
    print "<pre>";
	print_r($bestelling);
	print "</pre>";
}catch (BestaatException $ex){
	print("het bestaat al");
}