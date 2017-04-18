<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 8:53
 */

require_once ("Business/ProductService.php");
require_once ("bootstrap.php");
session_start();
$winkelmandje = array();
if (isset($_SESSION["winkelmandje"])){
	$winkelmandje = unserialize($_SESSION["winkelmandje"]);
}else{

}
if (isset($_GET["action"])&& $_GET["action"]=="toevoegen"){
	$id = $_GET["id"];
	if($winkelmandje[$id]){
		$winkelmandje[$id]["aantal"] += 1;
	}else{
		$aantal = array("product" => $id,"aantal"=> 1);
		$winkelmandje[$id] = $aantal;
	}

	$_SESSION["winkelmandje"] = serialize($winkelmandje);
	Doorverwijzen::doorverwijzen("toonallepizzas.php");
}
if(isset($_GET["action"])&& $_GET["action"] =="verwijder"){
	$id = $_GET["id"];
	if($winkelmandje[$id]){
		if ($winkelmandje[$id]["aantal"] == 1){
			unset($winkelmandje[$id]);
		}else{
			$winkelmandje[$id]["aantal"]-=1;
		}
	}
	$_SESSION["winkelmandje"] = serialize($winkelmandje);
	Doorverwijzen::doorverwijzen("toonallepizzas.php");


}