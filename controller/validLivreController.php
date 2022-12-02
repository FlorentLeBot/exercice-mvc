<?php

class validLivreController
{
    public function __construct()
    {
        session_start();
        error_reporting(0);

      //TODO
        if ($operation == "insert") {
        } else {
        //erreur on renvoit à la page d'accueil
            header('Location: accueil.php?id=' . $_SESSION["token"]);
        }
    }
}
