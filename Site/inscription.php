<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <?php require('../actions/inscription_action.php');
          require("../includes/head.php");
    ?>
  <body>
    <div class="form" id="inscription">
    <form method="POST" action="">
         <h1> Inscription</h1>
         <br>
         <div class="champ_form">
             <input type="text" name="nom" placeholder="Nom" required>
         </div>
         <br>
         <div class="champ_form">
             <input type="text" name="prénom" placeholder="Prénom" required>
         </div>
        <br>
        <div class="champ_form">
             <input type="text"  name="pseudo" placeholder="Pseudo" required>
        </div>
        <br>
        <div class="champ_form">
             <input type="email" name="mail" placeholder="Email" required>
        </div>
        <br>
        <div class="champ_form">
             <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        <br>
        <div class="champ_form">
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
        </div>
        <br>
        <?php if(isset($error)){echo "<p id='error'>".$error."</p>";}?>
        <input type="submit" class="bouton" id="exception" name ="validate" value="Je m'inscris">
        <br><br>
        <a style="text-decoration :none;" href="connexion.php"><p style="color:#1a75ff;" >J'ai déjà un compte, je me connecte</p></a>
   </form>
 </div>
  </body>
</html>
