<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 10:30
 */
class Bestellijn
{
	private static $idMap = array();
	private $id;
	private $bestellingId;
	private $aantal;
	private $pizzaId;

	/**
	 * Bestellijn constructor.
	 * @param $orderId
	 * @param $bestellingId
	 * @param $aantal
	 * @param $pizzaId
	 */
	public function __construct($orderId, $bestellingId, $aantal, $pizzaId)
	{
		$this->id = $orderId;
		$this->bestellingId = $bestellingId;
		$this->aantal = $aantal;
		$this->pizzaId = $pizzaId;
	}

		public static function create($id, $bestellingId, $aantal, $pizzaId)
			{
				if(!isset(self::$idMap[$id])){
					self::$idMap[$id]=new Bestellijn($id,$bestellingId,$aantal,$pizzaId);
				}
				return self::$idMap[$id];
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
	public function getPizzaId()
	{
		return $this->pizzaId;
	}

	/**
	 * @param mixed $pizzaId
	 */
	public function setPizzaId($pizzaId)
	{
		$this->pizzaId = $pizzaId;
	}
}