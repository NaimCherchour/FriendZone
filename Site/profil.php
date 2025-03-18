<?php
session_start();
if(!$_SESSION['auth']){
  header("location:index.php");
}
require("../includes/navbar.php");
        $id=$_SESSION['id'];
        // on se conncet à la bdd pour recuperer les posts de l'user de la session 
        $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
        //cette condition est pour le cas de supression d'un post 
               if(isset($_GET['confirm']) && $_GET['confirm']=="yes" && isset($_GET['id'])) {  
               $idd =$_GET['id']; //on récupère le id du post 
               
               $res=mysqli_query($connect,"DELETE FROM posts WHERE pid=$idd"); //les commentaires sont automatiquement supprimés

                header("location:profil.php");
              }
        $posts=mysqli_query($connect,"SELECT * FROM posts WHERE uid='$id' ORDER BY date DESC "); 
        $user_posts=mysqli_fetch_all($posts,MYSQLI_ASSOC);

 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
  <div class="box">
           <div class="post" id="profil">
              <img src="../src/pdp.jpg" height="120px" alt="Photo de profil">
              <h2><?= $_SESSION['nom'] . ' ' . $_SESSION['prénom']; ?></h2>
              <h4>@<?php echo $_SESSION['pseudo']; ?></h4>
           </div>
           <br>
  
           <h2 style="text-align:center; text-decoration:underline">Posts</h2>
           <br>
          
           <?php //bouton pour ajouter un post
        
           echo"<a href='../Site/upload_post.php' class='bouton' id='signalement' style='width:200px ; margin-left:565px;' >Ajouter un post </a> ";
           echo"<br><br>";
 
           ?>

           <?php // recuperer tous les posts un par un 
               if(isset($user_posts)){
                   foreach ($user_posts as $posts) {
            ?>
      
                <div class="post">
                         <div class="card-header">
                              <img src="../src/pdp.jpg" height="30px"alt="Photo de profil">
                              <h5><?php echo "@".$_SESSION['pseudo'] ;?> </h5>
                                <!-- Signaler un post --> 
                                <?php $pid = $posts['pid'] ;
                                       echo "<a href='../actions/signaler_action.php?&id=$pid' style='padding-left:60%; text-decoration:none; color:#1a75ff;' > Signaler le post </a>"; 
                                       // affichage icon de confimation pour signifier que le post est signalé
                                      if( $_GET['pid'] == $pid && $_GET['msg']=="Post signalé") { ?> <br><br> <img src="../src/signal.png" height="30px" style="margin-left:5px;"> <?php } ?> 
                                <br><br>
                        </div>
      
                         <div class="card-body">
                                  <!-- le chemin vers la photo  -->
                                  <?php $chemin = $posts['photo'] ; 
                                  echo "<img src='$chemin' height='300px' alt='Photo du Post' />"; ?>

                                 <p><?php echo $posts['caption'];?></p>
                                 <p style="font-size:16px;"><?php echo "publié le : ".$posts['date']; ?></p>
                                 <p style="text-decoration:underline;color:gray;font-size:15px;"><?php echo $posts['nb_coms']." commentaires" ;?></p>
                         </div>
     
                         <div>
                              <?php //affichage des commentaires du post actuel
                                   $coms=mysqli_query($connect,"SELECT * FROM commentaire WHERE pid={$posts['pid']}");
                                   $post_coms=mysqli_fetch_all($coms,MYSQLI_ASSOC); 
                                  if(isset($post_coms)){
                                         foreach ($post_coms as $com) {
                                             $user = mysqli_query($connect, "SELECT * FROM users WHERE id = {$com['uid']}");
                                             $user_info = mysqli_fetch_assoc($user); ?>
                                              <div class="card-footer" >
                                                  <p>@<?php echo $user_info['pseudo'].":"; ?></p>
                                                  <p><?php echo $com['content']; ?></p>
                                                  <p><?php echo ", ".$com['date']; ?></p>
                                                  <?php $id_com=$com['id_com']; //supprimer vos commentaires
                                                           if($_SESSION['id']== $user_info['id']){ echo "<a href='../actions/supprimer_commentaire.php?&id={$id_com}'><img src='../src/supp.png' alt='supprimer commentaire' height='20px'>   </a>" ; } ?>
                                              </div>
                                              <br>
                                   <?php }  //passer au commentaire suivant 
                                       } ?>
                                  <!-- un lien qui permet à l'user d'ajouter un commentaire -->   
                                   <br>
                                      <?php $_SESSION['prev']=$_SERVER['REQUEST_URI']; //on sauvegarde l'url de la page pour y retourner apres avoir ajouter le commentaire?>
                                      <a href="../Site/ajouter_commentaire.php?pid=<?php echo $pid ;?>" class="bouton" id="exception" style="width:200px"; >Ajouter un commentaire </a> 
                                      <br>
                                   <!-- un lien qui permet à l'user de supprimer ses posts-->
                                    <br>
                                     <a  href="profil.php?action=supprimer&do=delete&id=<?php echo $posts['pid']; ?>" style="text-decoration:none;color:#1a75ff;font-size:25px;background-color:beige;" >Supprimer ce post</a>
                                    <br><br>
                          </div>
               
                        
                        <?php //confirmation de la supression 
                                     if(isset($_GET['do']) && $_GET['id'] == $posts['pid'] ){
                                               if( $_GET['action']=="supprimer" && $_GET['do']=="delete"){
                                                     $iddd=$_GET['id'];
                                                     echo "<div class='post'>";
                                                    //on confirme la suppression et on permet donc à l'user de revenir en arrière
                                                    echo "<p>Êtes vous sur de vouloir supprimer ce post ?  cette action est définitive et irréversible</p>";
                                                    echo "<br>";
                                                    echo "<a href='profil.php?action=supprimer&do=delete&id=$iddd&confirm=yes' style='text-decoration:none;color:#1a75ff;background-color:beige;' >Oui</a>";
                                                    echo "<br><br>";
                                                    echo "<a href='profil.php?action=supprimer' style='text-decoration:none;color:#1a75ff;background-color:beige;' >Retour</a>";
                                                    echo "</div>";
                                                    echo"<br>";
                                                 } 
                                       }

                          ?>
                  </div>
           <br>
          <?php } //passer au post suivant 
           }?>
      </div>
  </body>
</html>