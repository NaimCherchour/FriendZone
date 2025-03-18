<?php session_start(); 
      require('../actions/connexion_action.php'); ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <?php require("../includes/head.php"); ?>
   <body>
       <div class="form" id="connexion" >
            <!-- formulaire de connexion-->
            <form  method="POST" action="">
              <h1>Connexion</h1>
              <br>
              <div class="champ_form">
                  <!-- <label for="pseudo" >Pseudo : </label>  --> 
                  <input type="text" name="pseudo" placeholder="Pseudo" required>
              </div>
              <br>
              <div class="champ_form">
                  <input type="password" name="password" placeholder="Mot de passe" required>
              </div>
              <br>
              <!-- affichage message d'erreur si'l y en a-->
              <?php if(isset($error)){echo "<p id='error'>".$error."</p>";}?>
              
                                  <!-- dot notation (.) pour concaténer -->
              <input class ="bouton" id="exception" type="submit" name="validate" value="Se connecter">
              <br><br>
              <a style="text-decoration :none; color:#1a75ff" href="inscription.php" >Je n'ai pas de compte,je m'inscris</a>
            </form>
       </div>
  </body>
</html>
