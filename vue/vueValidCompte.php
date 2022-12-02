<?php
require_once "vue/Vue.php";
class vueValidCompte extends Vue {
    function afficheUpdate($msg){
        include "header.html";
  
            include "menu.php";
            echo '<div class="covered-img">';
            echo ' <div class="container">';
        echo'    <main role="main" class="inner">'; 
        echo'      <h1 >Compte mis à jour.</h1> ' ;
         echo'   <p class="lead">Les information de votre compte ont bien été mise à jour.</p>';
         echo "<p class='lead'> $msg  </p>";
         echo'  </main>';


            echo '</div>';
            echo '</div>';
        
include "footer.html";
}	
function modale ($msg){
    echo" <script>$('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
      })</script>";
   echo  '<div class="modal fade" tabindex="-1" role="dialog">';
   echo  ' <div class="modal-dialog" role="document">';
   echo  '  <div class="modal-content">';
   echo  '     <div class="modal-header">';
   echo  '       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
   echo  '       <h4 class="modal-title">Modal title</h4>';
   echo  '     </div>';
   echo  '     <div class="modal-body">';
   echo  '       <p>One fine body&hellip;</p>';
   echo  '     </div>';
   echo  '     <div class="modal-footer">';
   echo  '       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
   echo  '      <button type="button" class="btn btn-primary">Save changes</button>';
   echo  '    </div>';
   echo  '   </div><!-- /.modal-content -->';
   echo  ' </div><!-- /.modal-dialog -->';
   echo  '</div><!-- /';


}
}