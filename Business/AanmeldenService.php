<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 12:41
 */
require_once ("Data/KlantDAO.php");
require_once ("Exceptions/FouteLoginException.php");
class AanmeldenService
{

	public function aanmelden($email, $wachtwoord)
	{
		$klantDao = new KlantDAO();
		$klant = $klantDao->getAccountByEmail($email);
		if (isset($klant) && password_verify($wachtwoord,$klant->getWachtwoord())){
			return $klant;
		}else{
			throw new FouteLoginException();
		}
	}
}