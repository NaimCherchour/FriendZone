<?php require("head.php") ?>

<div class="navbar">
  <img style="border-radius:15px;" src="../src/logo.png" alt="Logo du site" height="50px">
  <?php
  echo "<a class='bouton' href='../Site/fil_actualite.php'> Fil d'actualité </a>";
  echo "<a class='bouton' href='../Site/profil.php'> Mon profil </a>";
  echo "<a class='bouton'href='../actions/deconnexion_action.php'> Déconnexion </a>";
  if($_SESSION['admin']){ //cas compte administrateur
    echo "<a class='bouton' href='../Site/espace_admin.php'> Espace admin </a>";
  }
  ?>
  <div class="searchbar">
    <form class="searchbar" action="../Site/resultat_recherche.php" method="GET">
        <input type="search" class="searchTerm" name="user_search" placeholder="Rechercher un utilisateur..."required>
        <input class="searchButton" type="submit" name="rechercher" value="🔍">
    </form>
  </div>
</div>

