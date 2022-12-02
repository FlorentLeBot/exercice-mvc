<?php
require_once "vue/Vue.php";
class vueAjoutLivre extends Vue {
	function affiche(){
	include "headerLivre.html";
        include "menu.php";

        echo '<div class="covered-img">';
        echo ' <div class="container">';
        echo'<div id="messagee"></div>';
        echo'<div id="msg"></div>';
        echo "<form method='post' class='verif_form_livre' action='index.php?operation=insert&action=validLivre&id=".$_SESSION['token']."' required>";
        echo " <div class='form-group'>";
        echo " <div class='form-row'>";
        echo "<label class='col-md-3' for='nom'>Nom</label>";
        echo '<input id="nom" type="text" class="form-control" name="nom" placeholder="Entrer le nom" required>';
        echo '</div>';
        echo " <div class='form-row'>";
        echo "<label for='auteur'>Auteur</label>";
        echo '<input id="auteur" type="text" class="form-control" name="auteur" placeholder="Entrer l \'auteur" required>';
        echo '</div>';
        echo " <div class='form-row'>";
        echo "<label for='edition'>Edition</label>";
        echo '<input id="edition" type="text" class="form-control" name="edition" placeholder="Entrer l \'édition" required>';
        echo '</div>';
        echo " <div class='form-row'>";
        echo "<label for='info'>Information</label>";
        echo '<input id="info" type="text" class="form-control" name="info" placeholder="Entrer les informations du livre">';
        echo '</div>';
        echo '</div>';

        echo '<button class="btn btn-primary" type="submit">Ajouter</button>';
        echo "</form>"; 

        echo '</div>';
        echo '</div>';


include "footer.html";
        }	
	
}