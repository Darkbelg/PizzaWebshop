<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:44
 */
class Straat
{
	private static $idMap = array();
	private $id;
	private $straat;
	private $huisnummer;

	/**
	 * Straat constructor.
	 * @param $id
	 * @param $straat
	 * @param $huisnummer
	 */
	public function __construct($id, $straat, $huisnummer)
	{
		$this->id = $id;
		$this->straat = $straat;
		$this->huisnummer = $huisnummer;
	}

		public static function create($id,$straat,$huisnummer)
			{
				if(!isset(self::$idMap[$id])){
					self::$idMap[$id]=new Straat($id,$straat,$huisnummer);
				}
				return self::$idMap[$id];
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
	public function getHuisnummer()
	{
		return $this->huisnummer;
	}

	/**
	 * @param mixed $huisnummer
	 */
	public function setHuisnummer($huisnummer)
	{
		$this->huisnummer = $huisnummer;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


}