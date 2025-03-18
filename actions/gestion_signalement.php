
        <?php
         //on se connecte à la bdd
          $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
          //cette condition est pour la supression d'un post 
          if(isset($_GET['confirm']) && $_GET['confirm']=="yes" && isset($_GET['id'])) {  
               $idd=$_GET['id'];              
               $res=mysqli_query($connect,"DELETE FROM posts WHERE pid=$idd"); // les commentaires sont supprimés automatiquement 
               header("location:espace_admin.php?action=signal");
         }


         //on récupère tous les posts signalés et on les stocke dans un tableau
         $res=mysqli_query($connect,"SELECT * FROM posts WHERE `signal`=1");
         $posts=mysqli_fetch_all($res,MYSQLI_ASSOC);
        ?>

        <?php
             if(isset($posts) && !empty($posts)){
             //on affiche les posts signalés un par un 
                     foreach ($posts as $post) {
                     //à chaque fois, on récupère le pseudo de la personne qui publie le post
                     $query=mysqli_query($connect,"SELECT pseudo FROM users WHERE id={$post['uid']}");
                     $publisher=mysqli_fetch_assoc($query);
         ?>
        
              <div class="post">
                         <div class="card-header">
                          <img src="../src/pdp.jpg" height="30px"alt="Photo De profil">
                         <h5><?php echo "@".$publisher['pseudo'] ;?> </h5>
                         <br><br>
                         </div>
            
                            <div class="card-body">
                            <?php $chemin = $post['photo'] ; 
                                  echo "<img src='$chemin' height='300px' alt='Photo du Post' />"; ?>
                            <p><?php echo $post['caption'];?></p>
                            <p style="font-size:16px;"><?php echo "publié le : ".$post['date']; ?></p>
                            <p style="text-decoration:underline;color:gray;font-size:15px;"><?php echo $post['nb_coms']." commentaires" ;?></p>
              
                             </div>
     
                            <div>
                                   <?php 
                                  $coms=mysqli_query($connect,"SELECT * FROM commentaire WHERE pid={$post['pid']}");
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
                                    <?php } } ?>

                                 <!-- un lien qui permet à l'admin de supprimer le post-->
                                <br><br>
                                <a  href="espace_admin.php?action=signal&do=delete&id=<?php echo $post['pid']; ?>" style='text-decoration:none;color:#1a75ff;background-color:beige;' >Supprimer ce post</a>
                                <br><br><br>
                             </div>
          
             <br><br>
                                       

                <?php
                  if(isset($_GET['do']) && $_GET['id'] == $post['pid']){
                     if( $_GET['action']=="signal" && $_GET['do']=="delete"){
                          $id=$_GET['id'];
                          echo "<div class='post'>";
                          //on confirme la suppression et on permet donc à l'admin de revenir en arrière
                          echo "<p>Êtes vous sur de vouloir supprimer ce post ?  cette action est définitive et irréversible</p>";
                          echo "<br>";
                          echo "<a href='espace_admin.php?action=signal&do=delete&id=$id&confirm=yes' style='text-decoration:none;color:#1a75ff;background-color:beige;'>Oui</a>";
                          echo "<br><br>";
                          echo "<a href='espace_admin.php?action=signal' style='text-decoration:none;color:#1a75ff;background-color:beige;' >Retour</a>";
                          echo "</div>";
                          echo"<br>";
                    } 
                 }

                ?>

        </div>
        <br><br>
<?php } //on passe au prochain post 
} 
?> 



