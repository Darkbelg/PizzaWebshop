<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 10:30
 */
class Bestelling
{
	private static $idMap = array();
	private $orderId;
	private $bestellingId;
	private $aantal;
	private $pizza;
	private $extra;

	/**
	 * Bestelling constructor.
	 * @param $orderId
	 * @param $bestellingId
	 * @param $aantal
	 * @param $pizza
	 */
	public function __construct($orderId, $bestellingId, $aantal, $pizza,$extra)
	{
		$this->orderId = $orderId;
		$this->bestellingId = $bestellingId;
		$this->aantal = $aantal;
		$this->pizza = $pizza;
		$this->extra=$extra;
	}

		public static function create($orderId, $bestellingId, $aantal, $pizza,$extra)
			{
				if(!isset(self::$idMap[$orderId])){
					self::$idMap[$orderId]=new Bestelling($orderId,$bestellingId,$aantal,$pizza,$extra);
				}
				return self::$idMap[$orderId];
			}

	/**
	 * @return mixed
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}

	/**
	 * @return mixed
	 */
	public function getBestellingId()
	{
		return $this->bestellingId;
	}

	/**
	 * @param mixed $bestellingId
	 */
	public function setBestellingId($bestellingId)
	{
		$this->bestellingId = $bestellingId;
	}

	/**
	 * @return mixed
	 */
	public function getAantal()
	{
		return $this->aantal;
	}

	/**
	 * @param mixed $aantal
	 */
	public function setAantal($aantal)
	{
		$this->aantal = $aantal;
	}

	/**
	 * @return mixed
	 */
	public function getPizza()
	{
		return $this->pizza;
	}

	/**
	 * @param mixed $pizza
	 */
	public function setPizza($pizza)
	{
		$this->pizza = $pizza;
	}
}