<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:38
 */
class Product
{
	private static $idMap = array();

	private $id;
	private $naam;
	private $prijs;
	private $beginDatum;
	private $eindDatum;
	private $promoKorting;
	private $omschrijving;
	private $extra;

	/**
	 * Product constructor.
	 * @param $id
	 * @param $naam
	 * @param $prijs
	 * @param $beginDatum
	 * @param $eindDatum
	 * @param $promoKorting
	 * @param $omschrijving
	 * @param $extra
	 */
	public function __construct($id, $naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving, $extra)
	{
		$this->id = $id;
		$this->naam = $naam;
		$this->prijs = $prijs;
		$this->beginDatum = $beginDatum;
		$this->eindDatum = $eindDatum;
		$this->promoKorting = $promoKorting;
		$this->omschrijving = $omschrijving;
		$this->extra = $extra;
	}

	public static function create($id, $naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving, $extra)
	{
		if(!isset(self::$idMap[$id])){
			self::$idMap[$id]=new Product($id, $naam, $prijs, $beginDatum, $eindDatum, $promoKorting, $omschrijving,$extra);
		}
		return self::$idMap[$id];
	}

	/**
	 * @return array
	 */
	public function getIngredienten(): array
	{
		return $this->ingredienten;
	}

	/**
	 * @param array $ingredienten
	 */
	public function setIngredienten(array $ingredienten)
	{
		$this->ingredienten = $ingredienten;
	}

	/**
	 * @return mixed
	 */
	public function getNaam()
	{
		return $this->naam;
	}

	/**
	 * @param mixed $naam
	 */
	public function setNaam($naam)
	{
		$this->naam = $naam;
	}

	/**
	 * @return mixed
	 */
	public function getPrijs()
	{
		return $this->prijs;
	}

	/**
	 * @param mixed $prijs
	 */
	public function setPrijs($prijs)
	{
		$this->prijs = $prijs;
	}

	/**
	 * @return mixed
	 */
	public function getBeginDatum()
	{
		return $this->beginDatum;
	}

	/**
	 * @param mixed $beginDatum
	 */
	public function setBeginDatum($beginDatum)
	{
		$this->beginDatum = $beginDatum;
	}

	/**
	 * @return mixed
	 */
	public function getEindDatum()
	{
		return $this->eindDatum;
	}

	/**
	 * @param mixed $eindDatum
	 */
	public function setEindDatum($eindDatum)
	{
		$this->eindDatum = $eindDatum;
	}

	/**
	 * @return mixed
	 */
	public function getPromoKorting()
	{
		return $this->promoKorting;
	}

	/**
	 * @param mixed $promoKorting
	 */
	public function setPromoKorting($promoKorting)
	{
		$this->promoKorting = $promoKorting;
	}

	/**
	 * @return mixed
	 */
	public function getOmschrijving()
	{
		return $this->omschrijving;
	}

	/**
	 * @param mixed $omschrijving
	 */
	public function setOmschrijving($omschrijving)
	{
		$this->omschrijving = $omschrijving;
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
	public function getExtra()
	{
		return $this->extra;
	}

	/**
	 * @param mixed $extra
	 */
	public function setExtra($extra)
	{
		$this->extra = $extra;
	}




}