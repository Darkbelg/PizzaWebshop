<?php
/**
 * Created by PhpStorm.
 * User: cyber09
 * Date: 13/04/2017
 * Time: 11:42
 */
require_once("bootstrap.php");
require_once("Business/KlantService.php");
session_start();
if (isset($_GET["action"])) {
    if ($_GET["action"] == "registreren") {

        if (isset($_POST["action"]) && $_POST["action"] == "registreren") {
            $twigarray = array("account" => true);
            $view = $twig->render("registreren.twig", $twigarray);
        } else {

            $view = $twig->render("registreren.twig");

        }
        print $view;
    }
    if ($_GET["action"] == "process") {
        if (isset($_POST["naam"])) {

            $klantServ = new KlantService();
            $klant = $klantServ->registreerKlant($_POST);
            if (isset($_POST["email"])) {
                $klant = $klantServ->registreerAccount($_POST["email"], $_POST["wachtwoord"],$klant->getKlantnummer());
            }
            $_SESSION["klant"] = serialize($klant->getKlantnummer());
            print $klant->getNaam();

            Doorverwijzen::doorverwijzen("afrekenen.php");

        } else {
            echo "Er is iets fout gelopen.";
        }

    }
} else {
    Doorverwijzen::doorverwijzen("aanmelden.php");
}