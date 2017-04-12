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
	private $gastenboekId;
	private $boodschap;
	private $datum;
	private $klantNummer;

	/**
	 * Gastenboek constructor.
	 * @param $zaakId
	 * @param $gastenboekId
	 * @param $boodschap
	 * @param $datum
	 * @param $klantNummer
	 */
	public function __construct($zaakId, $gastenboekId, $boodschap, $datum, $klantNummer)
	{
		$this->zaakId = $zaakId;
		$this->gastenboekId = $gastenboekId;
		$this->boodschap = $boodschap;
		$this->datum = $datum;
		$this->klantNummer = $klantNummer;
	}

		public static function create($zaakId,$gastenboekId,$boodschap,$datum,$klantNummer)
			{
				if(!isset(self::$idMap[$zaakId])){
					self::$idMap[$zaakId]=new Gastenboek($zaakId,$gastenboekId,$boodschap,$datum,$klantNummer);
				}
				return self::$idMap[$zaakId];
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
	public function getKlantNummer()
	{
		return $this->klantNummer;
	}

	/**
	 * @param mixed $klantNummer
	 */
	public function setKlantNummer($klantNummer)
	{
		$this->klantNummer = $klantNummer;
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
	public function getGastenboekId()
	{
		return $this->gastenboekId;
	}




}