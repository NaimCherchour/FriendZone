
 <?php
              $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
              //cette condition est pour la supression d'un user
              if(isset($_GET['confirm']) && $_GET['confirm']=="yes" && isset($_GET['id']) ){
                  $idd=$_GET['id'];
                  //après confirmation, suppression du compte et redirection vers l'espace de gestion des utilisateurs
                     // mettre à jour le nombre de commentaires des posts d'abord
                  $query=mysqli_query($connect,"SELECT * FROM `commentaire` WHERE uid='$idd'"); 
                  $row=mysqli_fetch_all($query,MYSQLI_ASSOC);
                  mysqli_query($connect,"DELETE FROM commentaire WHERE uid=$idd"); //on supprime ses commentaires
                  if ( isset($row) ){  //pour modifier le nombre de commentaires des posts qu'il a commenté
                   
                    foreach ( $row as $postid ){
                        
                        $po = $postid['pid'] ;
                        $query2=mysqli_query($connect,"SELECT nb_coms FROM `posts` WHERE pid='$po'");
                        
                        $row2=mysqli_fetch_assoc($query2);
                        
                        $nb=$row2['nb_coms']-1;
                        
                        mysqli_query($connect,"UPDATE `posts` SET `nb_coms`='$nb' WHERE `posts`.`pid`='$po';");
                        
                    }
                  }

                  $res=mysqli_query($connect,"DELETE FROM users WHERE id=$idd");
                   // les commentaires sont automatiquement supprimés ainsi que ses posts et ses souscriptions 
                 

                  header("location:espace_admin.php?action=users");
                  }
              //on récupère le pseudo et l'id de chaque utilisateur.
              $res=mysqli_query($connect,"SELECT pseudo,id FROM users");
              $users=mysqli_fetch_all($res,MYSQLI_ASSOC);
 ?>

 <div>
        <?php
            if(isset($users)){
                 foreach ($users as $user) {
         ?>
        <br>
             <!--on affiche chaque utilisateur séparemment, avec un bouton de supression -->
               <div class="post">
                         <div class="card-header">
                                 <img src="../src/pdp.jpg" height="45px"alt="Photo De profil">
                                 <h2>@<?php echo $user['pseudo'];?><h2>
                         </div>
      
                         <div class="card-body">
                                   <a href="espace_admin.php?action=users&do=delete&id=<?=$user['id'];?>" style="text-decoration:none;color:#1a75ff;background-color:beige;font-size:20px;" >Supprimer cet utilisateur</a>
                         </div>
         
               </div>

            <?php } // on passe au prochain user 
                }?>
            <br>
   
       <?php //confirmation de la supression 
           if(isset($_GET['do'])){
                  if($_GET['action']=="users" && $_GET['do']=="delete"){
                        $id=mysqli_real_escape_string($connect,$_GET['id']);
                 /* On a choisi de ne pas laisser l'utilisateur connecté supprimer son propre compte
                 */
            if($id!=$_SESSION['id']){
                echo "<div class='post' id='except'>";
                echo "<p>Êtes vous sur de vouloir supprimer cet utilisateur ? cette action est définitive et irréversible</p>";
                echo "<br>";
                echo "<a href='espace_admin.php?action=users&do=delete&id=$id&confirm=yes' style='text-decoration:none;color:#1a75ff;background-color:beige'>Oui</a>";
                echo "<br><br>";
                echo "<a href='espace_admin.php?action=users' style='text-decoration:none;color:#1a75ff;background-color:beige;' >Retour</a>";
                echo "</div>";
                
           } else{
                echo "<div class='post' id='except'>";
                echo "<p>Vous ne pouvez pas suprimer votre propre compte</p>";
                echo "<br>";
                echo "<a href='espace_admin.php?action=users' style='text-decoration:none;color:#1a75ff;background-color:beige;'>retour</a>";
                echo "</div>";
            }
        }
    }
    ?>
 </div>