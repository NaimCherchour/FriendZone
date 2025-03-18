<?php
session_start();
if(isset($_POST['validate'])) {
   if( (!empty($_POST['caption'])) && !empty($_FILES['photo']) ) {
               $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");

               $target_dir = "../src/"; // on stocke les photos sur le dossier src               
               $photo_name = uniqid('post_', true).'.'.pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
               $target_file = $target_dir . basename($photo_name);
               move_uploaded_file($_FILES['photo']['tmp_name'], "../src/".$photo_name); // on copie l'image dans src
               $image_path = mysqli_real_escape_string($connect, $target_file);

              $description=mysqli_real_escape_string($connect,$_POST['caption']);
              $uid=mysqli_real_escape_string($connect,$_SESSION['id']);
              $content=mysqli_real_escape_string($connect,nl2br(htmlspecialchars($_POST['caption'])));
              // Insérer le nouveau post dans la base de données
              $res = mysqli_query($connect,"INSERT INTO `posts`(`uid`, `photo`, `caption`) VALUES ('$uid','$image_path','$content')");
              $success = "Post publié";
              header("location:../Site/profil.php");
             // Vérifier si une image a été sélectionnée
             /* if($_FILES['photo']['error'] == 0){
             // Définir un nom unique pour la photo
                $photo_name = uniqid('post_', true).'.'.pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
              // Déplacer la photo vers le dossier de stockage
               move_uploaded_file($_FILES['photo']['tmp_name'], "../src/".$photo_name); */
   
     } else {
      $error = "Veulliez remplir tout les champs" ;
     }
}
?>

