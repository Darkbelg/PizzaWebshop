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
	public function getZaakByNaam($naam)
	{
		$zaakDAO = new ZaakDAO();
		$zaak = $zaakDAO->getZaak($naam);
		return $zaak;
}
}