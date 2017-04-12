<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:53
 */


class StraatDAO
{
	public function getStraatById($id)
	{
		$dbh= DBConfig::openConnectie();
		$sql = "select * from straat WHERE straatId =:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$straat = Straat::create($rij["straatId"],$rij["straat"],$rij["huisnummer"]);
		$dbh=DBConfig::sluitConnectie();
		return $straat;
	}
}