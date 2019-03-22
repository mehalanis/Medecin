<!DOCTYPE html>
<?php
require 'php/database.inc';
session_start();
if(isset($_POST["exit"])){
  session_destroy();
}
if((isset($_POST['email']))&&(isset($_POST['password']))){


$database=new database();
$result=$database->query("select * from user where user='".$_POST['email']."' and password='".md5($_POST['password'])."'");
$cpt=0;
while ($row=mysqli_fetch_assoc($result)) {
  $cpt++;
}
if($cpt==1){
  $_SESSION['email']=$_POST['email'];
  $_SESSION['password']=md5($_POST['password']);
  header("location: index.php");
}
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <form method="post" action="Login.php">
      <div class="body">
      <div class="login">
         <div class="content">
           <div class="image">
             <img src="img/coverindex.png" alt="">
           </div>
           <div class="email">
             <span class="member">Login</span>
             <?php if((isset($_POST['email']))&&(isset($_POST['password']))){ ?>
             <div class="erreur member">
               <label>Nom d’utilisateur ou Mot de passe erroné</label>
             </div>
              <?php } ?>
             <div class="input">
               <img class="icon" src="img/user32px.png" alt="">
                <input class="text" type="text" name="email" value="" placeholder="Nom d’utilisateur">
             </div>
             <div class="input">
               <img class="icon" src="img/password32px.png" alt="">
               <input class="text" type="Password" name="password" value="" placeholder="Mot de passe">
             </div>
             <button class="btn" type="submit" name="button">Entrez</button>
           </div>
         </div>
      </div>
    </div>
    </form>
  </body>
</html>
