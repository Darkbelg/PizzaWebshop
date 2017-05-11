<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 10/04/2017
 * Time: 15:22
 */
require_once ("vendor/autoload.php");
require_once ("Exceptions/BestaatException.php");
require_once ("Libraries/Doorverwijzen.php");
//require_once("Libraries/Twig/Autoloader.php");
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("Presentation");
$twig = new Twig_Environment($loader);
//defaults de number__format naar 2 nummers achter de komma
	$twig->getExtension('Twig_Extension_Core')->setNumberFormat(2,","," ");