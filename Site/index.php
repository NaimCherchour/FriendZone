<?php
     session_start();  
     if(!isset($_SESSION['auth'])){
        $_SESSION['auth']=false;
     }
?>
<!DOCTYPE html>
  <html lang="fr" dir="ltr">
  <?php require("../includes/head.php"); ?> <!-- Pour éviter la duplication des éléments de la section head -->
  <body>
        <div class="content">
             <br><br><br><br>
             <h1 style="color:white;font-family:'Futura';font-size:60px;"> FriendZone </h1>
             <h2 style="color:white;font-family:'Futura';font-size:30px;"> Capturer l'instant et partager avec des amis </h2>
             <br><br>
             <?php
                if(!$_SESSION['auth']){
                echo "<a class='bouton' href='connexion.php'> Connexion </a> ";
                echo "<br><br>";
                echo "<a class='bouton' href='inscription.php'> Inscription </a>";
                } else {
                  header('location:profil.php');           
                }
             ?>
        </div>
        <footer> <p> © 2023 Naïm Cherchour, Paul Nabti Université Paris Cité . All rights reserved. </p> </footer>
   </body>
  </html>