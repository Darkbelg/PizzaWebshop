<?php
//TODO DONE veranderen van namen
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:44
 */
class Stad
{
	private static $idMap = array();
	private $id;
	private $postcode;
	private $stad;

	/**
	 * Stad constructor.
	 * @param $id
	 * @param $postcode
	 * @param $stad
	 */
	public function __construct($id, $postcode, $stad)
	{
		$this->id = $id;
		$this->postcode = $postcode;
		$this->stad = $stad;
	}

		public static function create($id,$postcode,$stad)
			{
				if(!isset(self::$idMap[$id])){
					self::$idMap[$id]=new Stad($id,$postcode,$stad);
				}
				return self::$idMap[$id];
			}

	/**
	 * @return mixed
	 */
	public function getPostcode()
	{
		return $this->postcode;
	}

	/**
	 * @param mixed $postcode
	 */
	public function setPostcode($postcode)
	{
		$this->postcode = $postcode;
	}

	/**
	 * @return mixed
	 */
	public function getStad()
	{
		return $this->stad;
	}

	/**
	 * @param mixed $stad
	 */
	public function setStad($stad)
	{
		$this->stad = $stad;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}



}