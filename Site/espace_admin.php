<?php
session_start();
require("../includes/navbar.php");
    if(! ($_SESSION['auth'] && $_SESSION['admin']) ){
        header("location:index.php");
     }
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <body>
    <div class="admin">
          <h1 style="color:white">Espace administrateur</h1>
          <br><br>
          <a class="bouton" id="signalement" href="espace_admin.php?action=signal">Gérer les signalements</a> 
          <br><br>
          <a class="bouton" id="signalement" href="espace_admin.php?action=users">Gérer les utlisateurs</a></h1>
    </div>
    
    <?php
      if(isset($_GET['action'])){
         if($_GET['action']=="signal"){
          require("../actions/gestion_signalement.php");
        }elseif ($_GET['action']=="users"){
          require("../actions/gestion_users.php");
        } else {
          header("location:espace_admin.php");
        }
      }
      ?>
  </body>
</html>