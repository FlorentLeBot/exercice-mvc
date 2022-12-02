<?php
require_once "vue/Vue.php";
require_once "metier/Personne.php";
    /** fonction permettant d'afficher les caractéristiques du compte utilisateur */
class vueMonCompte extends Vue {
    /** fonction permettant d'afficher les caractéristiques du compte utilisateur */
    function affiche(Personne $pers){
        include "header.html";
         include "menu.php";
         echo '<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet"/>';
       echo '<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>';
        echo '<script src="js/jquery.ui.datepicker-fr.js"></script>';
        echo ' <script>
        $( function() {
            $.datepicker.setDefaults($.datepicker.regional["fr"]);
            $( "#datepicker" ).datepicker();
       } );
         </script>';
              /** cas ou l'utilisateura une  d'adresse,car different de 9999  (voir monCompteController.php) */
         $numero="";
          $codePostal="";
           if($pers->getAdresse()->getNumero()!=9999){
            $numero=$pers->getAdresse()->getNumero();
             $codepostal=$pers->getAdresse()->getCodePostal();
         }
            echo '<div class="covered-img">';

            echo ' <div class="container">';
           
            echo "<form method='post' action='index.php?operation=update&action=validCompte&id=".$_SESSION['token']."' required>";
            echo " <div class='form-group'>";
            echo " <div class='form-row'>";
            echo "<label class='col-md-3' for='nom'>Nom</label>";
            echo '<input id="nom" type="text" class="form-control" name="nom" value="'.$pers->getNom().'" placeholder="Entrer votre nom"  required>';
            echo '</div>';
            echo " <div class='form-row'>";
            echo "<label for='prenom'>Prenom</label>";
            echo '<input id="prenom" type="text" class="form-control" name="prenom" value="'.$pers->getPrenom().'"placeholder="Entrer votre prénom" required>';
            echo '</div>';
            echo " <div class='form-row'>";
            echo "<label for='datenaiss'>Date de Naissance</label>";
            echo '<input id="datepicker" type="text" class="form-control" name="datenaiss"  value="'.$pers->getDatenaissance()->format('d/m/Y').'"placeholder="Entrer votre date de naissance" required>';
            echo '</div>';
            echo " <div class='form-row'>";
            echo "<label for='tel'>Téléphone</label>";
            echo '<input id="tel" type="text" class="form-control" name="tel"  value="'.$pers->getTelephone().'" placeholder="Entrer votre téléphone" required>';
            echo '</div>';
            echo "<div class='form-row'>";
            echo "<label for='email'>Email</label>";
            echo '<input id="email" type="text" class="form-control" name="email"  value="'.$pers->getEmail().'" placeholder="Entrer votre Email" required>';
            echo '</div>';
            echo "<div class='form-row'>";
            echo "<label for='login'>Login</label>";
            echo '<input id="login" type="text" class="form-control" name="login"  value="'.$pers->getLogin().'" placeholder="Entrer votre Login" readonly>';
            echo '</div>';
            echo "<div class='form-row'>";
            echo "<label for='pwd'>Mot de passe</label>";
            echo '<div id="msg"></div>'; echo '<div id="msg2"></div>';
            echo '<input id="pwd" type="password" class="form-control" name="pwd"   placeholder="Entrer votre nouveau mot de passe" required>';
            echo '<input id="pwd2" type="password" class="form-control" name="pwd2"   placeholder="Confirmer votre nouveau mot de passe"required >';
            echo '</div>';
            echo " <div class='form-group'>";
            echo "<div class='form-row'>";
            echo "<label for='num'>Numéro</label>";         
            echo '<input id="num" type="text" class="form-control" name="num"  value="'.$numero.'" placeholder="Entrer votre numéro de  rue" required>';
            echo '</div>';
            echo "<div class='form-row'>";
            echo "<label for='rue'>Rue</label>";
            echo '<input id="rue" type="text" class="form-control" name="rue"  value="'.$pers->getAdresse()->getRue().'" placeholder="Entrer votre  rue" required>';
            echo '</div>';
            echo "<div class='form-row'>";
            echo "<label for='cp'>Code postal</label>";
            echo '<input id="cp" type="text" class="form-control" name="cp"  value="'.$codepostal.'" placeholder="Entrer votre code postal" required>';
            echo '</div>';
            echo "<div class='form-row'>";
            echo "<label for='vi'>Ville</label>";
            echo '<input id="vi" type="text" class="form-control" name="ville"  value="'.$pers->getAdresse()->getVille().'" placeholder="Entrer votre  ville" required>';
            echo '</div>';
            echo '</div>';
            echo '<button class="btn btn-primary" type="submit" onclick="return validate();">Valider</button>';          
            echo "</form>";
         
            echo '</div>';
            echo '</div>';

    include "footer.html";
            }	
}