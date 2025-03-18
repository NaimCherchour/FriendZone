<?php
        $connect=mysqli_connect("localhost","root","","FriendZone2") or die("Erreur de connexion");
        if ( isset($_GET['id']) ) {
        $pid=$_GET['id']; //id du post  à signaler
        $res=mysqli_query($connect,"UPDATE `posts` SET `signal`='1' WHERE pid=$pid");
        header("location:" . $_SERVER['HTTP_REFERER'] . "?&msg=Post signalé&pid=$pid");
        exit();
        }
?>
