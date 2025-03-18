<?php
        session_start();
        
        $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
        if ( isset($_GET['idsuiv']) && !empty($_GET['idsuiv']) ) {
           $id_suivi=$_GET['idsuiv']; // la personne qu'on veut suivre : celle ou je suis dans son profil
           $id_user = $_SESSION['id']; //l'user de la session
           $result = mysqli_query($connect, "SELECT statut FROM souscription WHERE id_user='$id_user' AND id_suivi='$id_suivi'");
           $row = mysqli_fetch_assoc($result);
           if(empty($row)){ mysqli_query($connect, "INSERT INTO `souscription`(`id_user`, `id_suivi`) VALUES ('$id_user','$id_suivi')"); }
           if( $row['statut']==1 ) { //on se désabonne
               mysqli_query($connect,"UPDATE `souscription` SET `statut`='0' WHERE id_suivi=$id_suivi AND id_user=$id_user");
               header("location:" . $_SERVER['HTTP_REFERER'] . "?&msg=unfollowed");}
           else {  // on s'abonne
               mysqli_query($connect,"UPDATE `souscription` SET `statut`='1' WHERE id_suivi=$id_suivi AND id_user=$id_user");
               header("location:" . $_SERVER['HTTP_REFERER'] . "?&msg=followed");
           }
        exit();
        }
?>