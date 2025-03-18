<?php
session_start();
if(!$_SESSION['auth']){
  header("location:../Site/index.php");
}
require("../includes/navbar.php"); 
require("../actions/ajouter_post_actions.php");
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <body>
      <div class="postcom" >
              <form method="POST" enctype="multipart/form-data" >
                 <div class="card-header" >    
                    <img src="../src/pdp.jpg" height="30px"alt="">      
                     <p>@<?php echo $_SESSION['pseudo']; ?> </p> 
                  </div>
                  <br><br>
                  <div >   
                        <input type="file" name="photo" required>
                  </div>
                  <br>
                  <!-- <label for="caption" >Ajouter une description</label> -->
              <div class="champ_form" > 
                   <textarea  name="caption" rows="3" cols="70"  placeholder="Ajouter une description..." required></textarea>    
</div>
                 <br>
            <?php if(isset($error)){echo $error ;}?>
            <?php if(isset($success)){echo $success ;}?>
            <div class="champ_form" > 
                 <input type="submit" id="exception" class="bouton" name="validate" value="Publier">
             </div>
            <br>
            
           </form>
       </div>
</body>
</html>
