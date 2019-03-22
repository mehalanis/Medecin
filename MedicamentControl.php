<!DOCTYPE html>
<?php
require 'php/database.inc';
include 'php/verefieuser.php';
require 'php/Medicament.inc';

$database=new database();

if(isset($_POST["AjouteMedicament"])){
  $medicament=new Medicament("",$_POST["NomMedicament"]);
  $medicament->InsertMedicament();
  header("location: medicament.php");
}elseif(isset($_POST["ModifieMedicament"])){
  $medicament=new Medicament($_POST["IdMedicament"],$_POST["NomMedicament"]);
  $medicament->ModifieMedicament();
  header("location: medicament.php");
}elseif(isset($_POST["Annuler"])){
  header("location: medicament.php");
}

if(isset($_GET["idMedicamentEdit"])){
  $result=$database->query("select * from medicament where id_medicament=".$_GET["idMedicamentEdit"]);
  $row=mysqli_fetch_assoc($result);
  $medicament=new Medicament($row["id_medicament"],$row["nom_medicament"]);
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
      <form class="" action="MedicamentControl.php" method="post">
        <div class="detail">
        <label class="titrebar"><?php if(isset($_GET["idMedicamentEdit"])){echo "Modifie ";}else{echo "Ajoute ";} ?> Malade</label>
        <hr>
        <div class="control">
        <div class="Controllistinput">
            <table class="Controltableinfo">
              <tr>
                 <td class="ControltableinfoC1"><label class="controllabel">Nom :</label></td>
                 <td><input type="text" class="controltext" name="NomMedicament" value="<?php
                                  if(isset($_GET["idMedicamentEdit"])){ echo $medicament->name; }
                                  ?>" >
                 </td>
              </tr>
            </table>
            <input type="hidden" name="IdMedicament" value="<?php
                  if(isset($_GET["idMedicamentEdit"])){echo $_GET["idMedicamentEdit"];}
                  ?>">
        </div>
        <div class="Controlimg"> </div>
      </div>
      <hr>
      <div class="controlbutton">
          <?php if(isset($_GET["idMedicamentEdit"])){$btn="Modifie";}else{ $btn="Ajoute";} ?>
          <input type="submit" name="<?php echo $btn."Medicament"; ?>" value="<?php echo $btn; ?>" class="controlbtn controlbtnoperation">
          <input type="submit" name="Annuler" value="Annuler" class="controlbtn controlbtnannuler">
      </div>
    </div>
    </form>
    </div>
  </div>
  </body>
</html>
