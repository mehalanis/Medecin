<!DOCTYPE html>
<?php
require 'php/database.inc';
include 'php/verefieuser.php';
if(isset($_POST["AjouteMalade"])){
  require "php/Malade.inc";
  $malade=new Malade("",$_POST["matricule"],$_POST["nom"],$_POST["prenom"],$_POST["date_naissance"]);
  $id=$malade->InsertMalade();
  header("location: Consulter.php?idMaladeConsulter=".$id."#Ordonnance");
}elseif(isset($_POST["ModifieMalade"])){
  require "php/Malade.inc";
  $malade=new Malade($_POST["id_malade"],$_POST["matricule"],$_POST["nom"],$_POST["prenom"],$_POST["date_naissance"]);
  $malade->ModifieMalade();
  header("location: Malade.php");
}elseif (isset($_POST["Annuler"])) {
  header("location: Malade.php");
}
$database=new database();
if(isset($_GET["idMaladeEdit"])){
  $database=new database();
  $result=$database->query("select * from malade where id_malade=".$_GET["idMaladeEdit"]);
  $malade=mysqli_fetch_assoc($result);
}
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
      <form class="" action="MaladeControl.php" method="post">
        <div class="detail">
        <label class="titrebar"><?php if(isset($_GET["idMaladeEdit"])){echo "Modifie ";}else{echo "Ajoute ";} ?> Malade</label>
        <hr>
        <div class="control">
        <div class="Controllistinput">
            <table class="Controltableinfo">
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">Matricule :</label></td>
                 <td><input type="text" class="controltext" name="matricule" value="<?php
                                  if(isset($_GET["idMaladeEdit"])){ echo $malade["matricule"]; }
                                  ?>" >
                 </td>
              </tr>
              <tr>
                <td class="ControltableinfoC1"><label class="controllabel">Nom :</label></td>
                <td><input type="text" class="controltext" name="nom" value="<?php
                          if(isset($_GET["idMaladeEdit"])){ echo $malade["nom"]; } ?>" >
                 </td>
              </tr>
              <tr>
                <td class="ControltableinfoC1"><label class="controllabel">Prenom :</label></td>
                <td><input type="text" class="controltext" name="prenom" value="<?php
                                if(isset($_GET["idMaladeEdit"])){ echo $malade['prenom']; } ?>" >
                </td>
              </tr>
              <tr>
                <td class="ControltableinfoC1"><label class="controllabel">Date de naissance :</label></td>
                <td><input type="date" class="controltext" name="date_naissance" value="<?php
                               if(isset($_GET["idMaladeEdit"])){ echo $malade["date_naissance"];}?>" >
                </td>
              </tr>
            </table>
            <input type="hidden" name="id_malade" value="<?php if(isset($_GET["idMaladeEdit"])){echo $_GET["idMaladeEdit"];}?>">
        </div>
        <div class="Controlimg">  </div>
      </div>
      <hr>
      <div class="controlbutton">
          <?php if(isset($_GET["idMaladeEdit"])){$btn="Modifie";}else{ $btn="Ajoute";} ?>
          <input type="submit" name="<?php echo $btn."Malade"; ?>" value="<?php echo $btn; ?>" class="controlbtn controlbtnoperation">
          <input type="submit" name="Annuler" value="Annuler" class="controlbtn controlbtnannuler">
      </div>
    </div>
    </form>
    </div>
  </div>
  </body>
</html>
