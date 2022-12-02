<?php

class validCompteController
{
    public function __construct()
    {
        session_start();
        error_reporting(0);
        require_once "controller/Controller.php";
        require_once "vue/vueValidCompte.php";
        require_once "metier/Personne.php";
        require_once "metier/Adresse.php";
        require_once "PDO/PersonneDB.php";
        require_once "PDO/AdresseDB.php";
        require_once "PDO/connectionPDO.php";
        require_once "Constantes.php";



//recuperation des valeurs du compte venant du formulaire MonCompte
    //personne
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $dateNaissance = $_POST['datenaiss'] ?? null;
        $tel = $_POST['tel'] ?? null;
        $email = $_POST['email'] ?? null;
        $login = $_POST['login'] ?? null;
        $pwd = $_POST['pwd'] ?? null;
    //adresse
        $num = $_POST['num'] ?? null;
        $rue = $_POST['rue'] ??  null;
        $cp = $_POST['cp'] ?? null;
        $ville = $_POST['ville'] ?? null;
    //action pour update ou insert, delete, select selectall
        $operation = $_GET['operation'] ?? null;

        //l'action peut etre passé en GET si elle ne l'ai pas en POST
        if ($operation == null) {
            $operation = $_POST['operation'] ?? null;
        }
        if (Controller::auth()) {
            if ($operation == "insert") {
            //Création de l'objet personne
            //TODO
                try {
        //connexion a la bdd
                    $accesPersBDD = new PersonneDB($pdo);
            //TODO insertion de la pers en bdd
                }
            //levée d'exception si probleme insertion en base de données
                catch (Exception $e) {
        //appel de la constantes définit dans Contantes.php pour afficher un message compréhensible
        //pour l'utilisateur
                    throw new Exception(Constantes::EXCEPTION_INSERT_DB_PERS);
                }
            } elseif ($operation == "update") {
                try {
        //update de l'objet personne

                    $dt = DateTime::createFromFormat('d/m/Y', $dateNaissance);
                    $pers = new Personne($nom, $prenom, $dt, $tel, $email, $login, md5($pwd));
                    $pers->setId($_SESSION['id']);
        // update adresse

                    $adresse = new Adresse(0, $num, $rue, $cp, $ville);

        //connexion a la bdd
                    $accesPersBDD = new PersonneDB($pdo);

            //update pers en bdd
                    $accesPersBDD->update($pers);

        //update adresse en db
                    $accesAdresseDB = new AdresseDB($pdo);

                    $adr = $accesAdresseDB->selectAdresseIdPers($_SESSION['id']);

                    $adr->setNumero($adresse->getNumero());
                    $adr->setRue($adresse->getRue());
                    $adr->setCodePostal($adresse->getCodepostal());
                    $adr->setVille($adresse->getVille());
                    $accesAdresseDB->update($adr);


        //appel de la vue pour afficher message d'insertion
                    $v = new vueValidCompte();
                    $v->afficheUpdate(Constantes::MESSAGE_VALID_UP);
                }
            //levée d'exception si probleme insertion en base de données
                catch (Exception $e) {
        // cas ou la pers n'a pas d'adresse généré par la levé d'exception
                    $accesAdresseDB->ajout($adresse, $_SESSION['id']);
                    $v = new vueValidCompte();
                    $v->afficheUpdate(Constantes::MESSAGE2_VALID_UP);
                }
            } elseif ($operation == "selectAll") {
            //TODO afficher personnes
            }
        } else {
            //erreur on renvoit à la page d'accueil
            header('Location: index.php?id=' . $_SESSION["token"]);
        }
    }
}
