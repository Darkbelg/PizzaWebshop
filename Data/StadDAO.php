<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:53
 */
require_once ("DBConfig.php");
require_once ("Entities/Stad.php");

class StadDAO
{
	public function getStradById($id)
	{
		$dbh= DBConfig::openConnectie();
		$sql = "select * from plaats WHERE plaatsId =:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$stad = Straat::create($rij["plaatsId"],$rij["postcode"],$rij["stad"]);
		$dbh=DBConfig::sluitConnectie();
		return $stad;
	}
}