<!DOCTYPE html>
<?php
require 'php/database.inc';
include 'php/verefieuser.php';
require 'php/Medicament.inc';

if (isset($_GET["RemoveMedicament"])) {
    $medicament=new Medicament($_GET["RemoveMedicament"],"");
    $medicament->RemoveMedicament();
}

$database =new database();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/standard.css">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/SideBar.css">
    <link rel="stylesheet" href="css/Mobile.css">
    <script type="text/javascript" src="js/Malade.js">

    </script>
  </head>
  <body >
    <?php include 'html/NavBar.html';  ?>
    <div class="page">
      <?php include 'html/SideBar.html';  ?>
      <div class="contenu">
        <div class="btnstandarajoute">
          <a href="MedicamentControl.php" >
            <img src="img/add.png" alt="erreur">
            <label for="">Ajoute</label>
          </a>
        </div>
        <div class="detail">
          <label class="titrebar">List Medicament</label>
          <hr>
          <form action="Medicament.php" method="GET">
            <div class="standardrecherchebar">
              <div class="standardrecherche">
                <input type="text" name="rech" id="RechMalade">
                <button type="submit"><img src="img/search24pxwhite.png"></button>
              </div>
            </div>
          </form>
          <table class="produittable">
            <thead>
              <tr>
                <th class="headtable" abbr="name">Nom</th>
                <th id="operation"  abbr=''>Operation</th>
              </tr>
            </thead>
            <tbody id="tablemalade">
              <?php
                $get="";
                foreach ($_GET as $k => $v) {
                    if($k!="page"){
                      $get.=$k."=".$v."&";
                    }
                }
                if(isset($_GET['page'])){
                  $page=$_GET['page'];
                  $debut=$_GET['page']*10-10;
                }else{
                  $debut=0;
                  $page=1;
                }
                $sql="";
                if(isset($_GET["rech"])){
                  $sql=" where nom_medicament like '%".$_GET["rech"]."%' ";
                }
                $request="select id_medicament,nom_medicament from medicament $sql limit $debut,10";
                $result=$database->query($request);
                $array=array();
                while ($row=mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  $id_medicament=$row['id_medicament'];
                  unset($row["id_medicament"]);
                  foreach ($row as $key => $value) {
                    echo "<td>".$value."</td>";
                  }
                  echo "<td>";
                  echo "<a class='produitbtn produitbtnedit' href='MedicamentControl.php?idMedicamentEdit=$id_medicament' href=>Modifie</a>";
                  echo "<a class='produitbtn produitbtnsupprime' href='RequestMedicament.php?RemoveMedicament=$id_medicament' href=>Supprimer</a>";
                  echo "</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
          <div class="tableinfo" id="tableinfo">
            <ul class='listinfo'>
                <?php
                function printitem($id,$style,$get)
                {
                  echo "<li class='$style'><a href='Medicament.php?".$get."page=$id'>$id</a></li>";
                }
                if(isset($_GET['page'])){
                  if($_GET['page']>1){
                    $precedant=$_GET['page']-1;
                    echo "<li class='suivprec'><a href='Medicament.php?".$get."page=$precedant'><img src='img/precedant.png'/></a></li>";
                    printitem($precedant,"listitem",$get);
                    printitem($_GET['page'],"itemactiv",$get);
                  }else{
                    echo "<li class='suivprec'><a href='Medicament.php?".$get."page=1'><img src='img/precedant.png'/></a></li>";
                    printitem(1,"itemactiv",$get);
                  }
                }else{
                  echo "<li class='suivprec'><a href='Medicament.php?".$get."page=1'><img src='img/precedant.png'/></a></li>";
                  printitem(1,"itemactiv",$get);
                }
                $suivant=$page*10;

                $result=$database->query("select id_medicament,nom_medicament from medicament $sql limit $suivant,2");
                
                if(isset($_GET['page'])){$suivant=$_GET['page'];}else{$suivant=1;}
                if(mysqli_num_rows($result)>0){
                  $suivant++;
                  printitem($suivant,"listitem",$get);
                 }
                  echo "<li class='suivprec'><a href='Medicament.php?".$get."page=$suivant'><img src='img/suivant.png'/></a></li></ul>";
                ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
