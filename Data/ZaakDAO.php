<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 10/04/2017
	 * Time: 14:54
	 */
	require_once "Entities/Zaak.php";
	require_once "DBConfig.php";
	require_once "Exceptions/NotANumberException.php";

	class ZaakDAO
	{

		public function getByNaam($naam)
		{
			$sql  = "select * from zaak WHERE naam=:naam";
			$dbh  = DBConfig::openConnectie();
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(':naam' => $naam));
			$rij  = $stmt->fetch(PDO::FETCH_ASSOC);
			$zaak = Zaak::create($rij["id"], $rij["naam"], $rij["voorwaarden"], $rij["beginPromoDatum"], $rij["eindPromoDatum"], $rij["promoAantalBestellingen"]);
			$dbh  = DBConfig::sluitConnectie();
			return $zaak;
		}

		public function getPromo($vandaag)
		{
//		$vandaag = '2017-05-15';
			$dbh  = DBConfig::openConnectie();
			$sql  = "SELECT naam FROM zaak WHERE :datum >= beginPromoDatum and :datum <= eindPromoDatum";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(':datum' => $vandaag));
			$rij = $stmt->fetch(PDO::FETCH_ASSOC);
			if(isset($rij["naam"])) {
				$dbh = DBConfig::sluitConnectie();
				return 1;
			}
			$dbh = DBConfig::sluitConnectie();
		}
		public function update($id, $beginDatum, $eindDatum, $aantal, $voorwaarden)
		{
			if(!is_numeric($aantal)) {
				throw  new NotANumberException("U moet een nummer invullen.");
			}
			if(!$this->validateDate($beginDatum) or !$this->validateDate($eindDatum)) {
				throw new NotADateException("Datum is verkeerd ingevuld");
			}
			if($beginDatum>$eindDatum){
				throw new Exception("Begindatum moet kleiner zijn dan de einddatum");
			}

			$dbh  = DBConfig::openConnectie();
			$sql  = "update zaak set voorwaarden =:voorwaarden,beginPromoDatum=:beginpromo,eindPromoDatum=:eindpromo,promoAantalBestellingen=:aantal WHERE id=:id";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(":voorwaarden" => $voorwaarden, ":beginpromo" => $beginDatum, ":eindpromo" => $eindDatum, ":aantal" => $aantal, ":id" => $id));
			$dbh = DBConfig::sluitConnectie();
		}
		private function validateDate($date)
		{
			$d = DateTime::createFromFormat('Y-m-d', $date);
			return $d && $d->format('Y-m-d') === $date;
		}
	}