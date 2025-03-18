<?php
session_start();
if(!$_SESSION['auth']){
  header("location:../Site/index.php");
}
require("../includes/navbar.php");
$connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
      
        if(isset($_GET['user_search'])){
              if(!empty($_GET['user_search'])){
                       if($_GET['user_search']=="*"){
                             $recherche="SELECT * FROM users";
                       }else{
                            $pseudo=mysqli_real_escape_string($connect,htmlspecialchars(trim($_GET['user_search']))); 
                            $recherche="SELECT * FROM users WHERE pseudo LIKE '%$pseudo%'";
                        }
                $users=mysqli_query($connect,$recherche) or die();
                $user_info=mysqli_fetch_all($users,MYSQLI_ASSOC);
                if(isset($user_info)) {
                      if (!empty($user_info)){ 
                          foreach ($user_info as $user) { 
?>
                     <br>
                     <!--on affiche chaque utilisateur séparemment, avec un bouton de afficher profil -->
                     <div class="post">
                            <div class="card-header">
                             <img src="../src/pdp.jpg" height="45px"alt="Photo de profil">
                             <h2>@<?php echo $user['pseudo'];?><h2>
                            </div>

                            <div class="card-body">
                            <a href="../Site/afficher_profil.php?&id=<?php echo $user['id'];?>" class="bouton" id="comment" " >Afficher le profil</a>
                            </div>
             
                     </div>
                        
                          <?php }  } else { //cas empty   ?>
              
                                          <div class="postcom" >
                                               <?php echo "Aucun utilisateur trouvé "; ?>
                                          </div>
                                     <?php }
                 } 
            }
          }
?>








