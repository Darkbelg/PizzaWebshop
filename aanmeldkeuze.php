<?php
	/**
	 * Created by PhpStorm.
	 * User: cyber09
	 * Date: 3/05/2017
	 * Time: 14:54
	 */
	require_once ("bootstrap.php");
	require_once ("login.php");
	if(isset($klant)){
		Doorverwijzen::doorverwijzen("afrekenen.php");
	}else{
		$view = $twig->render("aanmeldkeuze.twig");
		print ($view);
	}