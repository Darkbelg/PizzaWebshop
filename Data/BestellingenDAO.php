<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 11/04/2017
	 * Time: 15:20
	 */
	require_once "DBConfig.php";
	require_once "Entities/Bestellingen.php";
	require_once "Entities/Bestellijn.php";
	require_once "Entities/Product.php";
	require_once "Entities/Stad.php";
	require_once "Entities/Straat.php";
	require_once "Entities/Klant.php";
	require_once "Entities/Bestellijn.php";
	require_once "StraatDAO.php";
	require_once "StadDAO.php";
	require_once "ProductDAO.php";

	class BestellingenDAO
	{
		//oude manier van ophalen all orders met sql.
//	public function getAllOrders()
//	{
//		$dbh = DBConfig::openConnectie();
//		$sql = "select * from bestellingen order BY  datum DESC ";
//		$resultSet = $dbh->query($sql);
//		$lijst = array();
//		foreach ($resultSet as $rij) {
//			$stadDao = new StadDAO();
//			$stad = $stadDao->getById($rij["plaatsId"]);
//
//			$straat = StraatDAO::getById($rij["straatId"]);
//			$klantDao = new KlantDAO();
//			$klant = $klantDao->getById($rij["klantNummer"]);
//			$bestellijnen = $this->getBestellijnen($rij["id"]);
//
//			$bestellingen = Bestellingen::create($rij["id"],$rij["datum"],$rij["tijdstip"],$rij["info"],$klant,$straat,$stad,$bestellijnen);
//			array_push($lijst,$bestellingen);
//			//$order=Bestellingen::create();
//		}
//		$dbh = DBConfig::sluitConnectie();
//		return $lijst;
//
//	}
		public function getAllOrders()
		{
			$dbh = DBConfig::openConnectie();
			$sql = "SELECT * from bestellingenInfo";
			//view sql = SELECT b.id,b.datum,b.tijdstip,b.info,b.klantNummer,b.straatId,b.plaatsId,d.postcode,d.stad,s.straat,s.huisnummer,k.naam,k.voornaam,k.telefoon,k.emailadres,k.opmerking,k.promo,k.beheerder
			//FROM bestellingen AS b INNER JOIN stad as d on b.plaatsId = d.id
			//INNER JOIN straat AS s on b.straatId = s.id
			//INNER JOIN klant AS k on b.klantNummer = k.klantNummer
			//ORDER BY b.datum DESC
			$resultSet = $dbh->query($sql);
			$lijst = array();
			foreach ($resultSet as $rij) {

				$stad = Stad::create($rij["plaatsId"], $rij["postcode"], $rij["stad"]);
				$straat = Straat::create($rij["straatId"], $rij["straat"], $rij["huisnummer"]);
				$klant = Klant::create($rij["klantNummer"], $rij["naam"], $rij["voornaam"], $rij["telefoon"], $rij["emailadres"], "", $rij["opmerking"], $rij["promo"], $rij["beheerder"], $stad, $straat);
				$bestellijnen = $this->getBestellijnen($rij["id"]);
				$bestellingen = Bestellingen::create($rij["id"], $rij["datum"], $rij["tijdstip"], $rij["info"], $klant, $straat, $stad, $bestellijnen);
				array_push($lijst, $bestellingen);
				//$order=Bestellingen::create();
			}
			$dbh = DBConfig::sluitConnectie();
			return $lijst;

		}

		public function getBestellijnen($bestellingId)
		{
			$dbh = DBConfig::openConnectie();
			$sql = "select *,bestellijn.id as lid from bestellingen INNER JOIN bestellijn on bestellingen.id = bestellijn.bestellingId where bestellingId =:bestellingId";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(":bestellingId" => $bestellingId));
			$lijst = array();
			foreach ($stmt as $rij) {
				$bestellijn = Bestellijn::create($rij["lid"], $rij["bestellingId"], $rij["aantal"], $rij["productId"]);
				array_push($lijst, $bestellijn);
			}
			$dbh = DBConfig::sluitConnectie();
			return $lijst;
		}

		/**
		 * @param $id
		 * @return array
		 */
		public function getOrdersById($id)
		{
			$dbh = DBConfig::openConnectie();
			$sql = "select * from bestellingen WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(':id' => $id));
			$lijst = array();
			foreach ($stmt as $rij) {
				//$ingredienten = $this->getOrdersExtraPizzaId($rij["orderId"]);
				$pizzaDAO = new ProductDAO();
				$pizza = $pizzaDAO->getById($rij["pizzaId"]);
				$bestelling = Bestellijn::create($rij["id"], $rij["bestellingId"], $rij["aantal"], $pizza);
				array_push($lijst, $bestelling);
			}
			$dbh = DBConfig::sluitConnectie();
			return $lijst;

		}

		/**
		 * @param $datum
		 * @param $tijdstip
		 * @param $klantNummer
		 * @param $straat
		 * @param $stad
		 */
		public function create($datum, $tijdstip, $klantNummer, $straat, $stad)
		{
			$dbh = DBConfig::openConnectie();
			$sql = "INSERT into bestellingen(datum,tijdstip,klantNummer,straatId,plaatsId)VALUES(:datum,:tijdstip,:klantNummer,:straatId,:plaatsId)";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(":datum" => $datum, ":tijdstip" => $tijdstip, ":klantNummer" => $klantNummer, ":straatId" => $straat, "plaatsId" => $stad));
			$id = $dbh->lastInsertId();
			$bestelling = $this->getById($id);
			$dbh = DBConfig::sluitConnectie();
			$klantDao = new KlantDAO();
			$klantDao->setAanmerkingPromo($klantNummer);
			return $bestelling;

		}

		public function getById($id)
		{
			$dbh = DBConfig::openConnectie();
			$sql = "select * from bestellingen WHERE id = :id";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(":id" => $id));

			$rij = $stmt->fetch(PDO::FETCH_ASSOC);

			$bestellingen = Bestellingen::create($rij['id'], $rij['datum'], $rij['tijdstip'], $rij['info'], $rij['klantNummer'], $rij['straatId'], $rij['plaatsId'], "");

			$dbh = DBConfig::sluitConnectie();
			return $bestellingen;
		}

		public function createbestelLijn($bestellingId, $aantal, $productId)
		{
			$dbh = DBConfig::openConnectie();
			$sql = "insert into bestellijn(bestellingId, aantal, productId) VALUES (:bestellingId,:aantal,:productId)";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(":bestellingId" => $bestellingId, ":aantal" => $aantal, ":productId" => $productId));
			$rij = $stmt->fetch(PDO::FETCH_ASSOC);
			$dbh = DBConfig::sluitConnectie();
			return $rij;
		}

		private function getOrdersExtraPizzaId($orderId)
		{
			$dbh = DBConfig::openConnectie();
			$sql = "SELECT ingredientenId,naam,voedingswaarden,kostprijs,extra FROM bestelling INNER JOIN extraingredienten on bestelling.orderId = extraingredienten.orderId INNER JOIN ingredienten on extraingredienten.ingredientId = ingredienten.ingredientenId where extraingredienten.orderId = :order";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(':order' => $orderId));
			$lijst = array();
			foreach ($stmt as $rij) {
				$ingredient = Ingredient::create($rij["ingredientenId"], $rij["naam"], $rij["voedingswaarden"], $rij["kostprijs"], $rij["extra"]);
				array_push($lijst, $ingredient);
			}
			$dbh = DBConfig::sluitConnectie();
			return $lijst;

		}
	}