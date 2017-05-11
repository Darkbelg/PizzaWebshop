<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 10/04/2017
	 * Time: 14:55
	 */
	class DBConfig
	{
		public static $DB_CONNSTRING = "mysql:host=localhost;dbname=pizza;charset=utf8";
		public static $DB_USERNAME = "Papi";
		public static $DB_PASSWORD = "Pizza";
		public static function openConnectie(){
			return new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME,DBConfig::$DB_PASSWORD);
		}
		public static function sluitConnectie()
		{
			return null;
		}
	}