<?php
//TODO DONE veranderen van namen
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 11/04/2017
 * Time: 11:07
 */
class Klant
{
	private static $idMap=array();
	private $klantnummer;
	private $naam;
	private $voornaam;
	private $telefoon;
	private $emailadres;
	private $wachtwoord;
	private $opmerking;
	private $promo;
	private $beheerder;
	private $plaats;
	private $straat;


	/**
	 * Klant constructor.
	 * @param $klantnummer
	 * @param $naam
	 * @param $voornaam
	 * @param $telefoon
	 * @param $emailadres
	 * @param $wachtwoord
	 * @param $opmerking
	 * @param $promo
	 * @param $beheerder
	 * @param $plaats
	 * @param $straat
	 */
	public function __construct($klantnummer, $naam, $voornaam, $telefoon, $emailadres, $wachtwoord, $opmerking, $promo, $beheerder, $plaats, $straat)
	{
		$this->klantnummer = $klantnummer;
		$this->naam = $naam;
		$this->voornaam = $voornaam;
		$this->telefoon = $telefoon;
		$this->emailadres = $emailadres;
		$this->wachtwoord = $wachtwoord;
		$this->opmerking = $opmerking;
		$this->promo = $promo;
		$this->beheerder = $beheerder;
		$this->plaats = $plaats;
		$this->straat = $straat;
	}

		public static function create($klantnummer,$naam,$voornaam,$telefoon,$emailadres,$wachtwoord,$opmerking,$promo,$beheerder,$plaats,$straatId)
			{
				if(!isset(self::$idMap[$klantnummer])){
					self::$idMap[$klantnummer]=new Klant($klantnummer,$naam,$voornaam,$telefoon,$emailadres,$wachtwoord,$opmerking,$promo,$beheerder,$plaats,$straatId);
				}
				return self::$idMap[$klantnummer];
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
	public function getVoornaam()
	{
		return $this->voornaam;
	}

	/**
	 * @param mixed $voornaam
	 */
	public function setVoornaam($voornaam)
	{
		$this->voornaam = $voornaam;
	}

	/**
	 * @return mixed
	 */
	public function getTelefoon()
	{
		return $this->telefoon;
	}

	/**
	 * @param mixed $telefoon
	 */
	public function setTelefoon($telefoon)
	{
		$this->telefoon = $telefoon;
	}

	/**
	 * @return mixed
	 */
	public function getEmailadres()
	{
		return $this->emailadres;
	}

	/**
	 * @param mixed $emailadres
	 */
	public function setEmailadres($emailadres)
	{
		$this->emailadres = $emailadres;
	}

	/**
	 * @return mixed
	 */
	public function getWachtwoord()
	{
		return $this->wachtwoord;
	}

	/**
	 * @param mixed $wachtwoord
	 */
	public function setWachtwoord($wachtwoord)
	{
		$this->wachtwoord = $wachtwoord;
	}

	/**
	 * @return mixed
	 */
	public function getOpmerking()
	{
		return $this->opmerking;
	}

	/**
	 * @param mixed $opmerking
	 */
	public function setOpmerking($opmerking)
	{
		$this->opmerking = $opmerking;
	}

	/**
	 * @return mixed
	 */
	public function getPromo()
	{
		return $this->promo;
	}

	/**
	 * @param mixed $promo
	 */
	public function setPromo($promo)
	{
		$this->promo = $promo;
	}

	/**
	 * @return mixed
	 */
	public function getBeheerder()
	{
		return $this->beheerder;
	}

	/**
	 * @param mixed $beheerder
	 */
	public function setBeheerder($beheerder)
	{
		$this->beheerder = $beheerder;
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
	public function getKlantnummer()
	{
		return $this->klantnummer;
	}


}