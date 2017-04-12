<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 10:37
 */
class Bestellingen
{
	private static $idMap = array();

	private  $bestellingId;
	private $datum;
	private $tijdstip;
	private $info;
	private $klantNummer;
	private $straat;
	private $plaats;
	private $orders;

	/**
	 * BestellingenDAO constructor.
	 * @param $bestellingId
	 * @param $datum
	 * @param $tijdstip
	 * @param $info
	 * @param $klantNummer
	 * @param $straat
	 * @param $plaats
	 */
	public function __construct($bestellingId, $datum, $tijdstip, $info, $klantNummer, $straat, $plaats,$orders)
	{
		$this->bestellingId = $bestellingId;
		$this->datum = $datum;
		$this->tijdstip = $tijdstip;
		$this->info = $info;
		$this->klantNummer = $klantNummer;
		$this->straat = $straat;
		$this->plaats = $plaats;
		$this->orders=$orders;
	}

		public static function create($bestellingId, $datum, $tijdstip, $info, $klantNummer, $straat, $plaats,$orders)
			{
				if(!isset(self::$idMap[$bestellingId])){
					self::$idMap[$bestellingId]=new BestellingenDAO($bestellingId,$datum,$tijdstip,$info,$klantNummer,$straat,$plaats,$orders);
				}
				return self::$idMap[$bestellingId];
			}
	/**
	 * @return mixed
	 */
	public function getDatum()
	{
		return $this->datum;
	}

	/**
	 * @param mixed $datum
	 */
	public function setDatum($datum)
	{
		$this->datum = $datum;
	}

	/**
	 * @return mixed
	 */
	public function getTijdstip()
	{
		return $this->tijdstip;
	}

	/**
	 * @param mixed $tijdstip
	 */
	public function setTijdstip($tijdstip)
	{
		$this->tijdstip = $tijdstip;
	}

	/**
	 * @return mixed
	 */
	public function getInfo()
	{
		return $this->info;
	}

	/**
	 * @param mixed $info
	 */
	public function setInfo($info)
	{
		$this->info = $info;
	}

	/**
	 * @return mixed
	 */
	public function getStraat()
	{
		return $this->straat;
	}

	/**
	 * @param mixed $straat
	 */
	public function setStraat($straat)
	{
		$this->straat = $straat;
	}

	/**
	 * @return mixed
	 */
	public function getPlaats()
	{
		return $this->plaats;
	}

	/**
	 * @param mixed $plaats
	 */
	public function setPlaats($plaats)
	{
		$this->plaats = $plaats;
	}

	/**
	 * @return mixed
	 */
	public function getBestellingId()
	{
		return $this->bestellingId;
	}

	/**
	 * @return mixed
	 */
	public function getKlantNummer()
	{
		return $this->klantNummer;
	}

	/**
	 * @return mixed
	 */
	public function getOrders()
	{
		return $this->orders;
	}

	/**
	 * @param mixed $orders
	 */
	public function setOrders($orders)
	{
		$this->orders = $orders;
	}


}