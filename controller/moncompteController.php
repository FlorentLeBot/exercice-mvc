<?php

class moncompteController
{
    public function __construct()
    {
        session_start();
        error_reporting(0);
        require_once "controller/Controller.php";
        require_once "vue/vueMonCompte.php";
        require_once "metier/Personne.php";
        require_once "metier/Adresse.php";
        require_once "PDO/PersonneDB.php";
        require_once "PDO/AdresseDB.php";
        require_once "PDO/connectionPDO.php";
        require_once "Constantes.php";


        if (Controller::auth()) {
                    //connexion a la bdd
                   $accesPersBDD = new PersonneDB($pdo);
                   //get pers
                   $pers = $accesPersBDD->selectionId($_SESSION['id']);
                   $accesAdreBDD = new AdresseDB($pdo);
                   //get Adresse
            try {
                $adresse = $accesAdreBDD-> selectAdresseIdPers($pers->getId());
            } catch (Exception $e) {
                 $adresse = new Adresse(9999, 9999, "", 99999, "");
            }

                $pers->setAdresse($adresse);
            $v = new vueMonCompte();
            $v->affiche($pers);
        } else {
            header('Location: index.php?error=login');
        }
    }
}
