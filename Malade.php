<!DOCTYPE html>
<?php
require 'php/database.inc';
include 'php/verefieuser.php';
require 'php/Malade.inc';

if(isset($_GET["RemoveMalade"])){
  $malade=new Malade($_GET["RemoveMalade"],"","","","");
  $malade->RemoveMalade();
  header("location: Malade.php");
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
          <a href="MaladeControl.php" >
            <img src="img/add.png" alt="erreur">
            <label for="">Ajoute</label>
          </a>
        </div>
        <div class="detail">
          <label class="titrebar">List Malade</label>
          <hr>
          <form method="GET" action="Malade.php">
            <div class="standardrecherchebar">
              <div class="standardrecherche">
                <input type="text" name="rech" id="RechMalade" >
                <button type="submit"><img src="img/search24pxwhite.png"></button>
              </div>
            </div>
          </form>
          <table class="produittable">
            <thead>
              <tr>
                <th class="headtable" abbr="matricule">matricule</th>
                <th class="headtable" abbr="nom">Nom</th>
                <th class="headtable" abbr="prenom">Prenom</th>
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
                   $pos=strrpos($_GET["rech"],"/");
                   $sqldate='%d';
                   if($pos==true){
                     $formatdate=explode("/",$_GET["rech"]);  $cpt=0;
                     for($i=0;$i<count($formatdate);$i++){ if($formatdate[$i]!='') $cpt++; }
                     if(count($formatdate)!=$cpt){  $get = substr($_GET["rech"],0,strlen($get)-1); }
                     switch ($cpt) {
                       case 1:$sqldate='%d'; break;
                       case 2:$sqldate='%d/%m'; break;
                       case 3: $sqldate='%d/%m/%Y'; break;
                     }
                   }
                  if($get!="null"){
                    $sql="where matricule like '%".$_GET["rech"]."%' or nom like '%".$_GET["rech"]."%' or prenom like '%".$_GET["rech"]."%' or
                                        DATE_FORMAT(date_naissance, \"$sqldate\")='".$_GET["rech"]."'";
                  }
                }
                $request="select id_malade,matricule,nom,prenom from malade $sql limit $debut,10";
                $result=$database->query($request);
                $array=array();
                while ($row=mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  $idmalade=$row['id_malade'];
                  unset($row["id_malade"]);
                  foreach ($row as $key => $value) {
                    echo "<td>".$value."</td>";
                  }
                  echo "<td>";
                 echo "<a class='produitbtn produitbtnconsulter' href='Consulter.php?idMaladeConsulter=$idmalade#Ordonnance' href=>consulter</a>";
                  echo "<a class='produitbtn produitbtnedit' href='MaladeControl.php?idMaladeEdit=$idmalade' href=>Modifie</a>";
                  echo "<a class='produitbtn produitbtnsupprime' href='Malade.php?RemoveMalade=$idmalade' href=>Supprimer</a>";
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
                  echo "<li class='$style'><a href='Malade.php?".$get."page=$id'>$id</a></li>";
                }
                if(isset($_GET['page'])){
                  if($_GET['page']>1){
                    $precedant=$_GET['page']-1;
                    echo "<li class='suivprec'><a href='Malade.php?".$get."page=$precedant'><img src='img/precedant.png'/></a></li>";
                    printitem($precedant,"listitem",$get);
                    printitem($_GET['page'],"itemactiv",$get);
                  }else{
                    echo "<li class='suivprec'><a href='Malade.php?".$get."page=1'><img src='img/precedant.png'/></a></li>";
                    printitem(1,"itemactiv",$get);
                  }
                }else{
                  echo "<li class='suivprec'><a href='Malade.php?".$get."page=1'><img src='img/precedant.png'/></a></li>";
                  printitem(1,"itemactiv",$get);
                }
                $suivant=$page*10;

                $result=$database->query("select id_malade from malade $sql limit $suivant ,2");
                
                if(isset($_GET['page'])){$suivant=$_GET['page'];}else{$suivant=1;}
                if(mysqli_num_rows($result)>0){
                  $suivant++;
                  printitem($suivant,"listitem",$get);
                 }
                  echo "<li class='suivprec'><a href='Malade.php?".$get."page=$suivant'><img src='img/suivant.png'/></a></li></ul>";
                ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
