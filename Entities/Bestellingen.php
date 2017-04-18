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

	private $id;
	private $datum;
	private $tijdstip;
	private $info;
	private $klant;
	private $straat;
	private $plaats;
	private $bestellijn;

	/**
	 * BestellingenDAO constructor.
	 * @param $id
	 * @param $datum
	 * @param $tijdstip
	 * @param $info
	 * @param $klant
	 * @param $straat
	 * @param $plaats
	 * @param $bestellijn
	 */
	public function __construct($id, $datum, $tijdstip, $info, $klant, $straat, $plaats, $bestellijn)
	{
		$this->id = $id;
		$this->datum = $datum;
		$this->tijdstip = $tijdstip;
		$this->info = $info;
		$this->klant = $klant;
		$this->straat = $straat;
		$this->plaats = $plaats;
		$this->bestellijn = $bestellijn;
	}

	/**
	 * @param $id
	 * @param $datum
	 * @param $tijdstip
	 * @param $info
	 * @param $klant
	 * @param $straat
	 * @param $plaats
	 * @param $bestellijn
	 * @return mixed
	 */
	public static function create($id, $datum, $tijdstip, $info, $klant, $straat, $plaats, $bestellijn)
	{
		if (!isset(self::$idMap[$id])) {
			self::$idMap[$id] = new Bestellingen($id, $datum, $tijdstip, $info, $klant, $straat, $plaats, $bestellijn);
		}
		return self::$idMap[$id];
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
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getKlant()
	{
		return $this->klant;
	}

	/**
	 * @return mixed
	 */
	public function getBestellijn()
	{
		return $this->bestellijn;
	}

	/**
	 * @param mixed $bestellijn
	 */
	public function setBestellijn($bestellijn)
	{
		$this->bestellijn = $bestellijn;
	}


}