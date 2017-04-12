<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 14:49
 */
class Zaak
{
	private static $idMap = array();

	private $id;
	private $naam;
	private $voorwaarden;
	private $beginPromoDatum;
	private $eindPromoDatum;
	private $promoAantalBestellingen;

	/**
	 * Zaak constructor.
	 * @param $id
	 * @param $naam
	 * @param $voorwaarden
	 * @param $beginPromoDatum
	 * @param $eindPromoDatum
	 * @param $promoAantalBestellingen
	 */
	public function __construct($id, $naam, $voorwaarden, $beginPromoDatum, $eindPromoDatum, $promoAantalBestellingen)
	{
		$this->id = $id;
		$this->naam = $naam;
		$this->voorwaarden = $voorwaarden;
		$this->beginPromoDatum = $beginPromoDatum;
		$this->eindPromoDatum = $eindPromoDatum;
		$this->promoAantalBestellingen = $promoAantalBestellingen;
	}

	public static function create($id, $naam, $voorwaarden, $beginPromoDatum, $eindPromoDatum, $promoAantalBestellingen)
	{
		if(!isset(self::$idMap[$id])){
			self::$idMap[$id]= new Zaak($id, $naam, $voorwaarden, $beginPromoDatum, $eindPromoDatum, $promoAantalBestellingen);
		}
		return self::$idMap[$id];
	}
	/**
	 * @return mixed
	 */
	public function getVoorwaarden()
	{
		return $this->voorwaarden;
	}

	/**
	 * @param mixed $voorwaarden
	 */
	public function setVoorwaarden($voorwaarden)
	{
		$this->voorwaarden = $voorwaarden;
	}

	/**
	 * @return mixed
	 */
	public function getBeginPromoDatum()
	{
		return $this->beginPromoDatum;
	}

	/**
	 * @param mixed $beginPromoDatum
	 */
	public function setBeginPromoDatum($beginPromoDatum)
	{
		$this->beginPromoDatum = $beginPromoDatum;
	}

	/**
	 * @return mixed
	 */
	public function getEindPromoDatum()
	{
		return $this->eindPromoDatum;
	}

	/**
	 * @param mixed $eindPromoDatum
	 */
	public function setEindPromoDatum($eindPromoDatum)
	{
		$this->eindPromoDatum = $eindPromoDatum;
	}

	/**
	 * @return mixed
	 */
	public function getPromoAantalBestellingen()
	{
		return $this->promoAantalBestellingen;
	}

	/**
	 * @param mixed $promoAantalBestellingen
	 */
	public function setPromoAantalBestellingen($promoAantalBestellingen)
	{
		$this->promoAantalBestellingen = $promoAantalBestellingen;
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
	public function getNaam()
	{
		return $this->naam;
	}

}