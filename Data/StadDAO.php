<?php
// TODO CRUD
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:53
 */
require_once ("DBConfig.php");
require_once ("Entities/Stad.php");
require_once ("Exceptions/BestaatException.php");

class StadDAO
{
	public function getById($id)
	{
		$dbh= DBConfig::openConnectie();
		$sql = "select * from plaats WHERE plaatsId =:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$rij = $stmt->fetch(PDO::FETCH_ASSOC);
		$stad = Stad::create($rij["plaatsId"],$rij["postcode"],$rij["stad"]);
		$dbh=DBConfig::sluitConnectie();
		return $stad;
	}

	public function getAll()
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from stad";
		$resultSet = $dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij){
			$stad = Stad::create($rij["id"],$rij["postcode"],$rij["stad"]);
			array_push($lijst,$stad);
		}
		return $lijst;
	}

	public function getByNaam($naam)
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from stad where stad=:stad";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':stad'=>$naam));
		$rij =$stmt->fetch(PDO::FETCH_ASSOC);

		if(!$rij){
			$dbh = DBConfig::sluitConnectie();
			return null;
		}else{
			$stad = Stad::create($rij["id"],$rij["postcode"],$rij["stad"]);
			$dbh = DBConfig::sluitConnectie();
			return $stad;
		}
	}

	public function create($stad,$postcode)
	{
		$bestaatStad = $this->getByNaam($stad);
		if(!is_null($bestaatStad)){
			throw new BestaatException();
		}
		$dbh = DBConfig::openConnectie();
		$sql = "insert into stad(stad,postcode) VALUES (:stad,:postcode)";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(":stad"=>$stad,":postcode"=>$postcode));
		$id =$dbh->lastInsertId();
		$dbh = DBConfig::sluitConnectie();
		$stad = $this->getById($id);

		return $stad;
	}
	public function delete($id)
	{
		$dbh = DBConfig::openConnectie();
		$sql = "delete from stad WHERE id = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$dbh = DBConfig::sluitConnectie();
	}

	public function update($stad)
	{
		$bestaatStad = $this->getByNaam($stad->getStad());
		if(!is_null($bestaatStad)&&($bestaatStad->getId()!=$stad->getId())){
			throw new BestaatException();
		}
		$dbh = DBConfig::openConnectie();
		$sql = "update stad set stad =:stad , postcode =:postcode WHERE id =:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':stad'=>$stad->getStad(),':postcode'=>$stad->getPostcode(),':id'=>$stad->getId()));
		$dbh = DBConfig::sluitConnectie();
	}

	public function getLevergebied()
	{
		$dbh = DBConfig::openConnectie();
		$sql = "select * from levergebied INNER  JOIN  stad on levergebied.plaatsId = stad.id";
		$resultSet = $dbh->query($sql);
		$lijst = array();
		foreach ($resultSet as $rij){
			$stad = Stad::create($rij["id"],$rij["postcode"],$rij["stad"]);
			array_push($lijst,$stad);
		}
		return $lijst;
	}
}