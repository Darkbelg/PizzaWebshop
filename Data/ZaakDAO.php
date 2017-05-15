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


	public function getPromo($vandaag)
	{
//		$vandaag = '2017-05-15';
		$dbh = DBConfig::openConnectie();
		$sql = "SELECT naam FROM zaak WHERE :datum >= beginPromoDatum and :datum <= eindPromoDatum";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':datum'=>$vandaag));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		if(isset($rij["naam"])){
			$dbh = DBConfig::sluitConnectie();
		return 1;
		}
		$dbh = DBConfig::sluitConnectie();
	}
}