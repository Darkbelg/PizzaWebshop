<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 14:54
 */
require_once "Entities/Zaak.php";
require_once "DBConfig.php";

class ZaakDAO
{
	public function getByNaam($naam){
		$sql = "select * from zaak WHERE naam=:naam";
		$dbh = DBConfig::openConnectie();
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':naam'=>$naam));
		$rij = $stmt ->fetch(PDO::FETCH_ASSOC);
		$zaak = Zaak::create($rij["zaakId"],$rij["naam"],$rij["voorwaarden"],$rij["beginPromoDatum"],$rij["eindPromoDatum"],$rij["promoAantalBestellingen"]);
		$dbh=DBConfig::sluitConnectie();
		return $zaak;
	}
}