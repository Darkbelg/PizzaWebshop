<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:53
 */
require_once "DBConfig.php";
require_once "Entities/Straat.php";
require_once "Exceptions/StraatBestaatException.php";

class StraatDAO
{
	public static function getStraatById($id)
	{
		$dbh= DBConfig::openConnectie();
		$sql = "select * from straat WHERE id =:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$straat = Straat::create($rij["id"],$rij["straat"],$rij["huisnummer"]);
		$dbh=DBConfig::sluitConnectie();
		return $straat;
	}

	public function getAlleStraten()
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from straat";
		$resultSet = $dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij	){
			$straat = Straat::create($rij["id"],$rij["straat"],$rij["huisnummer"]);
			array_push($lijst,$straat);
		}
		$dbh = DBConfig::sluitConnectie();
		return $lijst;
	}

	public function getByStraat($straat,$huisNummer)
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from straat where straat=:straat and huisnummer = :huisnummer";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':straat'=>$straat,':huisnummer'=>$huisNummer));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$rij){
			$dbh = DBConfig::sluitConnectie();
			return null;
		}else{
			$straat = Straat::create($rij["id"],$rij["straat"],$rij["huisnummer"]);
			$dbh = DBConfig::sluitConnectie();
			return $straat;
		}
	}
	
	public function create($straat,$huisnummer){
		$bestaatStraat = $this->getByStraat($straat,$huisnummer);
		if(!is_null($bestaatStraat)){
			throw new StraatBestaatException();
		}
		$dbh = DBConfig::openConnectie();
		$sql = "insert into straat(straat, huisnummer) VALUES (:straat,:huisnummer)";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(":straat"=>$straat,":huisnummer"=>$huisnummer));

		$id = $dbh->lastInsertId();
		$dbh = DBConfig::sluitConnectie();
		$straat = $this->getStraatById($id);

		return $straat;
	}

	public function delete($id){
		$dbh = DBConfig::openConnectie();
		$sql = "delete from straat where id = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$dbh = DBConfig::sluitConnectie();
	}

	public function update($straat)
	{
		$bestaatStraat = $this->getByStraat($straat->getStraat(),$straat->getHuisnummer());
		if(!is_null($bestaatStraat)&& ($bestaatStraat->getId()!=$straat->getId())){
			throw new StraatBestaatException();
		}
		$dbh = DBConfig::openConnectie();
		$sql = "update straat set straat=:straat,huisnummer=:huisnummer where id = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':straat'=>$straat->getStraat(),':huisnummer'=>$straat->getHuisnummer(),':id'=>$straat->getId()));
		$dbh = DBConfig::sluitConnectie();
	}
}