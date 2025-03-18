<?php
if(isset($_POST['validate'])){
  if( !empty($_POST['nom']) && !empty($_POST['prénom']) && !empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
      //connexion à la base de données 
      $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
       //comme toujours, passage obligatoire par htmlspecialchars et mysqli_real_escape_string pour la sécurité
       $pseudo=mysqli_real_escape_string($connect,htmlspecialchars(trim($_POST['pseudo'])));
       $nom=mysqli_real_escape_string($connect,htmlspecialchars($_POST['nom']));
       $prénom=mysqli_real_escape_string($connect,htmlspecialchars($_POST['prénom']));
       $mail=mysqli_real_escape_string($connect,htmlspecialchars($_POST['mail']));
       $password=mysqli_real_escape_string($connect,htmlspecialchars($_POST['password']));
       $confirm_password=mysqli_real_escape_string($connect,htmlspecialchars($_POST['confirm_password']));
       //on regarde si les deux mots de passes sont les memes
       if($password==$confirm_password){
         /*on exige que le mot de passe soit sécurisé(au moins une majuscule,une minuscule, un chiffre
         et un caractère special)
         */
         $contient_majuscule = preg_match('@[A-Z]@', $password);
         $contient_minuscule = preg_match('@[a-z]@', $password);
         $contient_chiffre= preg_match('@[0-9]@', $password);
         $contient_cs= preg_match('@[^\w]@', $password);
         if($contient_cs && $contient_chiffre && $contient_majuscule && $contient_minuscule){
           //on crypte le mot de passe
           $password=password_hash($password,PASSWORD_DEFAULT);
           //on vérifie si il n'ya pas déjà un utilisateur avec cet username
           $res=mysqli_query($connect,"SELECT * FROM users WHERE pseudo='$pseudo'");
           $same_pseudo=mysqli_num_rows($res);
           if($same_pseudo==0){ // y'a aucun user avec ce pseudo 
           //ajout de l'utilisateur à la bdd, inscripiton réussie !!
           $query=mysqli_query($connect,"INSERT INTO users(pseudo,nom,prénom,mail,password) VALUES ('$pseudo','$nom','$prénom','$mail','$password')");
           //on authentifie l'utilisateur sur le site,on récupère les infos de l'utilisateur et on les stocke dans la session
           $user=mysqli_query($connect,"SELECT id,pseudo,nom,prénom,mail FROM users WHERE pseudo='$pseudo'");
           $user_data=mysqli_fetch_assoc($user);
           $_SESSION['auth']=true; //vaut vrai si l'utilisateur est autentifié sur le site
           $_SESSION['id']=$user_data['id'];
           $_SESSION['pseudo']=$user_data['pseudo'];
           $_SESSION['nom']=$user_data['nom'];
           $_SESSION['prénom']=$user_data['prénom'];
           $_SESSION['mail']=$user_data['mail'];
           $_SESSION['admin']=false; 
           //on redirige l'utilisateur vers la page de profil
           header('location:../Site/profil.php');
         }else{
         $error="Ce nom d'utilisateur est déjà pris";
         }
      }else{
        $error="votre mot de passe doit contenir au moins une majuscule,une minuscule, un chiffre
        et un caractère spécial";
      }
    }else{
       $error="Les mots de passe ne sont pas identiques";
  }
}else {
    $error="Veulliez remplir tous les champs";
  }
}
 ?>
