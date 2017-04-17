<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:09
 */
require_once "Business/KlantService.php";
require_once "Exceptions/BestaatException.php";
require_once "Data/KlantDAO.php";


try {
	$klantDao = new KlantService();
	$klant = array("naam"=>"bourn","voornaam"=>"jas","telefoon"=>"0476708084","straat"=>"jasonstreet","huisnummer"=>"28","stad"=>"bourne","postcode"=>"5600");
    $klant = $klantDao->registreerKlant($klant);
    $klant = $klantDao->registreerAccount("jason.bourne@nasa.com","123456789",$klant->getKlantnummer());

    print "<pre>";
	print_r($klant);
	print "</pre>";
}catch (BestaatException $ex){
	print("het bestaat al");
}