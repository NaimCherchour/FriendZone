<?php 
 session_start() ;
 require("../includes/navbar.php");
 if(!$_SESSION['auth']){
    header("location:index.php");
  }
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
       <div class="box">
              
               
                    <?php
                      $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
                      $id_user = $_SESSION['id'];
                      $souscriptions = mysqli_query($connect, "SELECT * FROM souscription WHERE id_user = $id_user AND statut = 1");
                      $ids_suivi = mysqli_fetch_all($souscriptions,MYSQLI_ASSOC);
                      echo"<br><br>";
                      if(empty($ids_suivi)) { echo "<h1 style='color:white;text-align:center;margin-right:25px;'> Abonnez vous à des amis ! </h1>" ;}
                      elseif(isset($ids_suivi)){
                       
                         foreach ($ids_suivi as $id_suivi) { 
                          $temp =  $id_suivi['id_suivi'] ;                   
                          $posts=mysqli_query($connect,"SELECT * FROM posts WHERE uid=$temp ORDER BY date DESC");
                          $all_posts=mysqli_fetch_all($posts,MYSQLI_ASSOC);    

                          if(isset($all_posts)){
                                  foreach ($all_posts as $posts) {
                                         //à chaque fois, on récupère le pseudo de la personne qui publie le post
                                         $query=mysqli_query($connect,"SELECT pseudo FROM users WHERE id={$posts['uid']}");
                                         $publisher=mysqli_fetch_assoc($query);
                    ?>
                    <div class="post">
                            <div class="card-header">
                                     <img src="../src/pdp.jpg" height="30px"alt="Photo de Profil">
                                     <h5><?php echo "@".$publisher['pseudo'] ;?> </h5>
                                     <!-- Signaler un post --> 
                                     <?php $pid=$posts['pid'] ;
                                          echo "<a href='../actions/signaler_action.php?&id=$pid' style='padding-left:60%; text-decoration:none; color:#1a75ff;' > Signaler le post </a>"; 
                                     if( $_GET['pid'] == $pid && $_GET['msg']=="Post signalé") { ?> <br><br> <img src="../src/signal.png" height="30px" style="margin-left:5px;" alt="post signalé"> <?php } ?> 
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
                                    <?php  //affichage des commentaires du post actuel
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
                                                           <?php $id_com=$com['id_com']; 
                                                           if($_SESSION['id']==$user_info['id']){ echo "<a href='../actions/supprimer_commentaire.php?&id={$id_com}'><img src='../src/supp.png' alt='supprimer commentaire' height='20px'></a>" ; } ?>
                                                     </div>
                                                     <br>    
                                     <?php } //next comment
                                       } ?>
                                     <br>
                                     <?php $_SESSION['prev']=$_SERVER['REQUEST_URI']; // on sauvegarde l'url de la page pour y retourner ?>
                                      <a href="../Site/ajouter_commentaire.php?pid=<?php echo $pid ; ?>" class="bouton" id="exception" style="width:200px"; >Ajouter un commentaire </a> 
                                      <br>
                                 </div>
     
                     </div>
                     <br>
                    <?php } } // the next post
                 }       // next user followed
                  } ?>
      </div>
</body>
</html>


