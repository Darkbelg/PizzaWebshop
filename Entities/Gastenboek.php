<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 10:44
 */
class Gastenboek
{
	private static $idMap = array();

	private $zaakId;
	private $id;
	private $boodschap;
	private $datum;
	private $klant;

	/**
	 * Gastenboek constructor.
	 * @param $zaakId
	 * @param $id
	 * @param $boodschap
	 * @param $datum
	 * @param $klant
	 */
	public function __construct($zaakId, $id, $boodschap, $datum, $klant)
	{
		$this->zaakId = $zaakId;
		$this->id = $id;
		$this->boodschap = $boodschap;
		$this->datum = $datum;
		$this->klant = $klant;
	}

		public static function create($zaakId, $id, $boodschap, $datum, $klant)
			{
				if(!isset(self::$idMap[$id])){
					self::$idMap[$id]=new Gastenboek($zaakId,$id,$boodschap,$datum,$klant);
				}
				return self::$idMap[$id];
			}
	/**
	 * @return mixed
	 */
	public function getBoodschap()
	{
		return $this->boodschap;
	}

	/**
	 * @param mixed $boodschap
	 */
	public function setBoodschap($boodschap)
	{
		$this->boodschap = $boodschap;
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
	public function getKlant()
	{
		return $this->klant;
	}

	/**
	 * @param mixed $klant
	 */
	public function setKlant($klant)
	{
		$this->klant = $klant;
	}

	/**
	 * @return mixed
	 */
	public function getZaakId()
	{
		return $this->zaakId;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}




}