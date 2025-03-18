<?php
session_start();
if(!$_SESSION['auth']){
  header("location:index.php");
}
require("../includes/navbar.php");
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
      <div class="postcom" >
            <form method="POST" >          
                <p style="margin-right:50px;">@<?php echo $_SESSION['pseudo']; ?> </p> 
                <br>
                <div class="champ_form">
                     <textarea name="com" rows="2" cols="45" placeholder="Ajouter un commentaire" required></textarea>
                </div>
                <br><br>
                <?php if(isset($error)){echo "<p id='error'>".$error."</p>";}?>
                <?php if(isset($success)){echo "<p>".$success."</p>";}?>
                <input type="submit" id="exception" class="bouton" name="validate" value="Publier">
           </form>
       </div>
 
 
      
</body>
</html>

   <?php
           if(isset($_POST['validate'])){
                if( !empty($_POST['com']) ) { 
                    $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
                         /*
                            on protège notre site contre les injections de code:
                            sql avec avec la fontion mysqli_real_escape_string
                            php html et javascript avec la fonction htmlspecialchars
                          */
                      $pid=mysqli_real_escape_string($connect,htmlspecialchars($_GET['pid']));
                      $uid=mysqli_real_escape_string($connect,$_SESSION['id']);
                      $com=mysqli_real_escape_string($connect,htmlspecialchars($_POST['com']));
                      //autoriser les sauts de lignes dans le contenu grace à la fonction nl2br
                      $content=mysqli_real_escape_string($connect,nl2br(htmlspecialchars($_POST['com'])));
                      $query=mysqli_query($connect,"INSERT INTO `commentaire`(`pid`, `uid`, `content`) VALUES ('$pid','$uid','$content')");
                      $query=mysqli_query($connect,"SELECT `id_com` FROM `commentaire` WHERE pid='$pid' ");
                      $nb=mysqli_num_rows($query);
                      $query=mysqli_query($connect,"UPDATE posts SET nb_coms='$nb' WHERE pid='$pid' ");
                      $success="Votre commentaire a été publié";
                      header("location:" . $_SESSION['prev']); //retourner à la page précédente                      
                 } else{
                      $error="Veulliez remplir le champ";
                      
                }
             }

    ?>
