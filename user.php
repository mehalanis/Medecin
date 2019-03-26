<?php
require 'php/database.inc';
include 'php/verefieuser.php';
require 'php/user.inc';
if(isset($_POST["Modifie"])){
  $user=new user($_POST["Modifie"],$_POST["nom"],$_POST["prenom"],$_POST["email"],$_POST["id_region"]
                                     ,$_POST["username"],$_POST["password"]);
  $user->UpdateUser();
}elseif (isset($_POST["Annuler"])) {
  header("location: index.php");
}
$database=new database();
$result=$database->query("select * from user where id_user=".$_SESSION["id_user"]);
$row=mysqli_fetch_assoc($result);
$user=new user($row["id_user"],$row["nom"],$row["prenom"],$row["email"],$row["id_region"]
                                   ,$row["username"],$row["password"]);
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/standard.css">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/SideBar.css">
    <link rel="stylesheet" href="css/ControlProduit.css">
    <link rel="stylesheet" href="css/Mobile.css">
    <script src="js/ControlProduit.js">
    </script>
  </head>
  <body>
    <?php include 'html/NavBar.html';  ?>
    <div class="page">
      <?php include 'html/SideBar.html';  ?>
    <div class="contenu">
      <form class="" action="user.php" method="post">
        <div class="detail">
        <label class="titrebar">Personal settings </label>
        <hr>
        <div class="control">
        <div class="Controllistinput">
          <?php if(isset($_POST["Modifie"])){  ?>
            <div class="AlertConfirme">
              <strong>Succès!</strong> Mise à jour du profil réussie
            </div>
           <?php } ?>
            <table class="Controltableinfo">
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">Nom :</label></td>
                 <td><input type="text" class="controltext" name="nom" value="<?php echo  $user->nom; ?>" >
                 </td>
              </tr>
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">Prenom :</label></td>
                 <td><input type="text" class="controltext" name="prenom" value="<?php echo  $user->prenom; ?>" >
                 </td>
              </tr>
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">Email :</label></td>
                 <td><input type="email" class="controltext" name="email" value="<?php echo  $user->email; ?>" >
                 </td>
              </tr>
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">region :</label></td>
                 <td>
                   <select class="controltext" name="id_region" required>
                     <?php
                      $result=$database->query("select * from region");
                      while ($row=mysqli_fetch_assoc($result)) {
                        if($user->id_region==$row['id_region']){
                          echo "<option value=\"".$row['id_region']."\" selected>".$row['id_region']." - ".$row["nom"]."</option> ";
                        }else{
                          echo "<option value=\"".$row['id_region']."\" >".$row['id_region']." - ".$row["nom"]."</option> ";
                        }
                      }
                     ?>
                   </select>
                 </td>
              </tr>
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">Username :</label></td>
                 <td><input type="text" required class="controltext" name="username" value="<?php echo  $user->username; ?>" >
                 </td>
              </tr>
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">Password :</label></td>
                 <td><input type="text" class="controltext" name="password" value="" >
                 </td>
              </tr>
            </table>
        </div>
        <div class="Controlimg">  </div>
      </div>
      <hr>
      <div class="controlbutton">
          <button type="submit" name="Modifie" class="controlbtn controlbtnoperation" value="<?php echo $user->id; ?>">
            Modifie
          </button>
          <input type="submit" name="Annuler" value="Annuler" class="controlbtn controlbtnannuler">
      </div>
    </div>
    </form>
    </div>
  </div>
  </body>
</html>
