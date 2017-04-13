<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 10:40
 */
class Doorverwijzen
{

	public static function doorverwijzen($link)
	{
		header("location:".$link);
		exit(0);
	}

	/**
	 * Doorverwijzen constructor.
	 */
	public function __construct()
	{
	}
}