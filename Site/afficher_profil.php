<?php //afficher le profil recherché
session_start();
if(!$_SESSION['auth']){
  header("location:index.php");
}
require("../includes/navbar.php");
    $id=$_GET['id'];
    $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
    if ($id == $_SESSION['id'])  { 
           // si c'est l'user de la session on le redirige vers le profil
           header("location:../Site/profil.php"); }
    else {
            $posts=mysqli_query($connect,"SELECT * FROM posts WHERE uid='$id' ORDER BY date DESC");
            $user_posts=mysqli_fetch_all($posts,MYSQLI_ASSOC);
            $utilisateur=mysqli_query($connect,"SELECT * FROM users WHERE id='$id'");
           $utilisateur_info=mysqli_fetch_assoc($utilisateur);

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
     <body>
       <div class="box">
              <div class="post" id="profil">
                    <img src="../src/pdp.jpg" height="120px"alt="Photo de Profil">
                    <h2><?= $utilisateur_info['nom'] . ' ' . $utilisateur_info['prénom']; ?></h2>
                    <h4>@<?php echo $utilisateur_info['pseudo']; ?></h4>
                    <!-- lien du follow -->
                    <?php 
                        $id_suivi = $utilisateur_info['id'] ; 
                        $id_user = $_SESSION['id'];
                        $resultt = mysqli_query($connect, "SELECT statut FROM souscription WHERE id_user='$id_user' AND id_suivi='$id_suivi'");
                        $roww = mysqli_fetch_assoc($resultt); 
                        if( $roww['statut']==1 ) { $follow="abonné" ; }
                        else { $follow="s'abonner" ;}  
                    ?>
                        <br>
                        <a class="bouton" id="comment" style="margin-left:10px;" href='../actions/follow.php?idsuiv=<?php echo $id_suivi ;?>'> <?php echo $follow ?> </a> 
                       <?php if(  $_GET['msg']=="followed") { ?> <br><img src="../src/signal.png" height="30px" style="margin-left:5px;" alt="Bien abonnée"> <?php } ?> 
                      <?php if(  $_GET['msg']=="unfollowed") { ?> <br> <img src="../src/supp.png" height="30px" style="margin-left:5px;" alt="Désabonné"> <?php } ?> 
               </div>
 
               <br>
  
               <h2 style="text-align:center; text-decoration:underline">Posts</h2>
  
               <br>
  
              <?php
                   if(isset($user_posts)){  //on affiche les posts
                       foreach ($user_posts as $posts) {
              ?>
   
                           <div class="post">
                                <div class="card-header">
                                      <img src="../src/pdp.jpg" height="30px"alt="Photo de profil">
                                      <h5><?php echo "@".$utilisateur_info['pseudo'] ;?> </h5>
                                      <?php $pid=$posts['pid'] ; //bouton signaler
                                      echo "<a href='../actions/signaler_action.php?&id=$pid' style='padding-left:60%; text-decoration:none; color:#1a75ff;' > Signaler le post </a>"; 
                                      if( $_GET['pid'] == $pid && $_GET['msg']=="Post signalé") { ?> <br><br> <img src="../src/signal.png" height="30px" style="margin-left:5px;" alt="Post signalé"> <?php } ?> 
                                      <br><br>
                              
                               </div>
      
                                <div class="card-body">
                                   <?php $chemin = $posts['photo'] ; 
                                       echo "<img src='$chemin' height='300px' alt='Photo du Post' />"; ?>
                                     <p><?php echo $posts['caption'];?></p>
                                     <p style="font-size:16px;"><?php echo "publié le : ".$posts['date']; ?></p>
                                     <p style="text-decoration:underline;color:gray;font-size:15px;"><?php echo $posts['nb_coms']." commentaires" ;?></p>
            
                                </div>
    
                                <div>
             
                                          <?php  // les commentaires du post
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
                                           <?php } //prochain comment
                                           } ?>
                                           <!-- un lien qui permet à l'user d'ajouter un commentaire -->   
                                          <br>
                                          <?php $_SESSION['prev']=$_SERVER['REQUEST_URI']; // on sauvegarde l'url de la page pour y retourner ?>
                                           <a href="../Site/ajouter_commentaire.php?pid=<?php echo $pid ; ?>" class="bouton" id="exception" style="width:200px"; >Ajouter un commentaire </a> 
                                           <br>
                                </div>
    
                           </div>
   
                           <br>
    
                          <?php } //prochain post
                            }?>
          </div>
  </body>
</html>

<?php } ?>