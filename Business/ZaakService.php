<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:15
 */
require_once "Data/ZaakDAO.php";

class ZaakService
{
	public function getByNaam($naam)
	{
		$zaakDAO = new ZaakDAO();
		$zaak = $zaakDAO->getByNaam($naam);
		return $zaak;
}
}