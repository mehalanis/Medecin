<!DOCTYPE html>
<?php
require 'php/database.inc';
require 'php/user.inc';
$database=new database();
session_start();
if(isset($_POST["exit"])){
  session_destroy();
}
if(isset($_POST["creer"])){
  $user=new user("",$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['id_region'],$_POST['username'],md5($_POST['password']));
  $user->InsertUser();
  $_SESSION['id_user']=$id_user;
  $_SESSION['username']=$_POST['username'];
  $_SESSION['password']=md5($_POST['password']);
  header("location: index.php");
}
if((isset($_POST['username']))&&(isset($_POST['password']))){
$result=$database->query("select * from user where username='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$cpt=0;
while ($row=mysqli_fetch_assoc($result)) {
  $cpt++; $id_user=$row['id_user'];
}
if($cpt==1){
  $_SESSION['id_user']=$id_user;
  $_SESSION['username']=$_POST['username'];
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
    <script type="text/javascript" src='js/login.js'>

    </script>
  </head>
  <body
      <div class="body">
       <div class="login">
         <div class="content">
           <div class="image">
             <img src="img/coverindex.png" alt="">
           </div>
           <div class="form" id="login_Compte">
             <span class="member">Login</span>
             <?php if((isset($_POST['email']))&&(isset($_POST['password']))){ ?>
             <div class="erreur member">
               <label>Nom d’utilisateur ou Mot de passe erroné</label>
             </div>
              <?php } ?>
              <form method="post" action="Login.php">
                <div class="input">
                  <img class="icon" src="img/user32px.png" alt="">
                   <input class="text" type="text" name="username" value="" placeholder="Nom d’utilisateur">
                </div>
                <div class="input">
                  <img class="icon" src="img/password32px.png" alt="">
                  <input class="text" type="Password" name="password" value="" placeholder="Mot de passe">
                </div>
                <button class="btn" type="submit" name="button">Entrez</button>
              </form>
               <a class="btn_creer" href="#" onclick="CreerCompte()">Creer Compte </a>
           </div>
           <div class="form form_hidden" id="Creer_Compte">
             <span class="member">Creer Compte</span>
              <form method="post" action="Login.php">
                <div class="input">
                  <img class="icon" src="img/user32px.png" alt="">
                   <input class="text" type="text" name="nom"  placeholder="Nom" required="required">
                </div>
                <div class="input">
                  <img class="icon" src="img/user32px.png" alt="">
                   <input class="text" type="text" name="prenom"  placeholder="Prenom" required="required">
                </div>
                <div class="input">
                  <img class="icon" src="img/email26px.png" alt="">
                   <input class="text" type="email" name="email"  placeholder="Email" required="required">
                </div>
                <div class="input">
                  <img class="icon" src="img/user32px.png" alt="">
                   <input class="text" type="text" name="username"  placeholder="Nom d’utilisateur" required="required">
                </div>
                <div class="input">
                  <img class="icon" src="img/password32px.png" alt="">
                   <input class="text" type="Password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="input">
                  <img class="icon" src="img/region38px.png" alt="" required>
                   <select  class="text" name="id_region" require>
                     <?php
                      $result=$database->query("select * from region");
                      while ($row=mysqli_fetch_assoc($result)) {
                          echo "<option value=\"".$row['id_region']."\" >".$row['id_region']." - ".$row["nom"]."</option> ";
                      }
                     ?>
                   </select>
                </div>
                <button class="btn" type="submit" name="creer">Creer</button>
              </form>
               <a class="btn_creer" href="#" onclick="CreerCompte()">Login </a>
           </div>
         </div>
      </div>
    </div>
  </body>
</html>
