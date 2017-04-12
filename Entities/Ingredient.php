<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:42
 */
class Ingredient
{
	private static $idMap = array();
	private $id;
	private $naam;
	private $voedingswaarden;
	private $kostprijs;
	private $extra;

	/**
	 * Ingredient constructor.
	 * @param $id
	 * @param $naam
	 * @param $voedingswaarden
	 * @param $kostprijs
	 * @param $extra
	 */
	public function __construct($id, $naam, $voedingswaarden, $kostprijs, $extra)
	{
		$this->id = $id;
		$this->naam = $naam;
		$this->voedingswaarden = $voedingswaarden;
		$this->kostprijs = $kostprijs;
		$this->extra = $extra;
	}

	public static function create($id, $naam, $voedingswaarden, $kostprijs, $extra)
	{
		if(!isset(self::$idMap[$id])){
			self::$idMap[$id]=new Ingredient($id, $naam, $voedingswaarden, $kostprijs, $extra);
		}
		return self::$idMap[$id];
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
	public function getVoedingswaarden()
	{
		return $this->voedingswaarden;
	}

	/**
	 * @param mixed $voedingswaarden
	 */
	public function setVoedingswaarden($voedingswaarden)
	{
		$this->voedingswaarden = $voedingswaarden;
	}

	/**
	 * @return mixed
	 */
	public function getKostprijs()
	{
		return $this->kostprijs;
	}

	/**
	 * @param mixed $kostprijs
	 */
	public function setKostprijs($kostprijs)
	{
		$this->kostprijs = $kostprijs;
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

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


}