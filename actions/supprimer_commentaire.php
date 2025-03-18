<?php
session_start();
$connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
if( isset($_GET['id'])) {  
    $id_com = $_GET['id'];
    $res=mysqli_query($connect,"SELECT pid FROM commentaire WHERE id_com='$id_com'");
    $comment=mysqli_fetch_all($res,MYSQLI_ASSOC);
    $pid=$comment[0]['pid'];
    $res=mysqli_query($connect,"DELETE FROM commentaire WHERE id_com='$id_com'");
    $query=mysqli_query($connect,"SELECT nb_coms FROM `posts` WHERE pid='$pid'");
    $row=mysqli_fetch_assoc($query);
    $nb=$row['nb_coms']-1;
    $query2=mysqli_query($connect,"UPDATE `posts` SET `nb_coms` = '$nb' WHERE `posts`.`pid` = '$pid';");
    header("location:" . $_SERVER['HTTP_REFERER']);
 }



?>