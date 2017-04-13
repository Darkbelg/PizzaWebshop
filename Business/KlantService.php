<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 13:30
 */
require_once ("Data/KlantDAO.php");
class KlantService
{
	public function toonKlanten()
	{
		$klantDAO = new KlantDAO();
		$klanten = $klantDAO->getKlanten();
		return $klanten;
	}

	public function registreerKlant($registreerData)
	{

	}

}