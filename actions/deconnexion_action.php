<?php
session_start();
/* pour eviter qu'un utilisateur non connecté accède à cette page via l'url, cela provequerait
une erreur */
if(!$_SESSION['auth']){
  header("location:../Site/index.php");
}
//on détruit la session et on redirige l'utilisateur vers l'acceuil
$_SESSION=array();
session_destroy();
header('location:../Site/index.php');
 ?>
