<?php
if(isset($_POST['validate'])){ // vérifier que le formulaire a été soumis
  if(!empty($_POST['pseudo']) && !empty($_POST['password'])){ //vérifier que les champs 'pseudo' et 'password' ne sont pas vides.
       //on se connecte à la base de données
       $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
       /* par mesure de sécurité on utilise htmlspecialchars et mysqli_real_escape_string 
       pour échapper les caractères spéciaux et éviter les injections SQL.
       trim() qui sert juste à enlever les espaces du pseudo */
        $pseudo=mysqli_real_escape_string($connect,htmlspecialchars(trim($_POST['pseudo'])));
        $password=mysqli_real_escape_string($connect,htmlspecialchars($_POST['password']));
        $res=mysqli_query($connect,"SELECT * FROM users WHERE pseudo='$pseudo' "); // qui contient les résultats de la requête SELECT
       //on vérifie si l'utilisateur existe
       $same_pseudo=mysqli_num_rows($res); //récupérer le nombre de lignes qui correspondent au nom d'utilisateur
       if($same_pseudo>0){
           $user_data=mysqli_fetch_assoc($res); //$user_data array will contain the user data of the user 
           //on compare le mot de passe en clair au mdp crypté
           if(password_verify($password,$user_data['password'])){
               //on authentifie l'utilisateur
               $_SESSION['auth']=true; //vaut vrai si l'utilisateur est autentifié sur le site
               $_SESSION['pseudo']=$user_data['pseudo'];
               $_SESSION['id']=$user_data['id'];
               $_SESSION['nom']=$user_data['nom'];
               $_SESSION['prénom']=$user_data['prénom'];
               //si l'utilisateur est naimcher ou paulnab, il aura accès à l'espace d'administateur
               // leurs mot de passe est respectivement : 123Qaz.   et    123Qaz..
               if($_SESSION['pseudo']=="naimcher" || $_SESSION['pseudo']=="paulnab"){
                  $_SESSION['admin']=true;
               }else{
                  $_SESSION['admin']=false;
               }
               //on redirige l'utilisateur vers sa page de profil
               header('location:../Site/profil.php');
               //on identifie les différentes erreurs pour pouvoir ensuite les afficher à l'utilisateur
           }else{
             $error="Mot de passe incorrect";  
           }
       }else{
         $error="Pseudo invalide";
       }
  }else {
    $error="Veulliez remplir tous les champs";
  }
}
 ?>
