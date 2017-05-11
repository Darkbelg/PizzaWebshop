<?php

/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 14:55
 */


class DBConfig
{

//	public static $DB_CONNSTRING = "mysql:host=eu-mm-auto-dub-01-b.cleardb.net;dbname=heroku_6a983ac56ffdd25;charset=utf8";
//	public static $DB_USERNAME = "bc1116b511b6d8";
//	public static $DB_PASSWORD = "c7796c42";


	public static function openConnectie(){
		$DB_CONNSTRING = $_ENV["DB_CONNSTRING"];
		$DB_USERNAME = $_ENV["DB_USERNAME"];
		$DB_PASSWORD = $_ENV["DB_PASSWORD"];

		return new PDO($DB_CONNSTRING,$DB_USERNAME,$DB_PASSWORD);
	}

	public static function sluitConnectie()
	{
		return null;
	}
}