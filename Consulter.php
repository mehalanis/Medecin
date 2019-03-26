<!DOCTYPE html>
<?php
require 'php/database.inc';
include 'php/verefieuser.php';
$database=new database();
if(isset($_GET["idMaladeConsulter"])){
  $database=new database();
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
    <link rel="stylesheet" href="css/consulter.css">
    <link rel="stylesheet" href="css/Mobile.css">
    <script src="js/ConsulterArchives.js">
    </script>
    <script src="js/ConsulterOrdonnance.js">
    </script>
  </head>
  <body onload="">
    <?php include 'html/NavBar.html';  ?>
    <div class="page">
      <?php include 'html/SideBar.html';  ?>
      <div class="contenu">
        <div class="detail">
          <label class="titrebar">Consulter</label>
          <hr>
          <div class="consulter">
            <div class="consulterbar">
              <a href="#Ordonnance">Ordonnance</a>
              <a href="#Archives">Archives</a>
            </div>
            <div class="consultercontenu">
              <form method="POST" action="pdf.php">
                <div class="consulterdetail" id="Ordonnance">
                <div class="consulterOrdonnance">
                  <div class="consulterajoutermedicament">
                    <table class="consultermedicamenttable">
                      <tr>
                        <th class="consultertablec1">Motif :</th>
                        <td><input type="text"  class="consultermedicamentinput" name="motif"></td>
                      </tr>
                      <tr>
                        <th class="consultertablec1">Nom Medicament :</th>
                        <td><input type="text" list="Medicament" class="consultermedicamentinput" id="nomMedicament" value=""></td>
                        <datalist id="Medicament">
                          <?php
                            $result=$database->query("select nom_medicament from medicament");
                            while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option value=\"".$row["nom_medicament"]."\"/>";
                            }
                           ?>
                        </datalist>
                      </tr>
                      <tr>
                        <th class="consultertablec1">Doz :</th>
                        <td>
                          <select class="consultermedicamentinput" id="dozMedicament">
                            <option value="1/jour" selected>1/jour</option>
                            <option value="2/jour">2/jour</option>
                            <option value="3/jour">3/jour</option>
                            <option value="4/jour">4/jour</option>
                            <option value="5/jour">5/jour</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th class="consultertablec1">Nombre de Boit :</th>
                        <td>
                          <select class="consultermedicamentinput" id="nbrboitMedicament">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </td>
                      </tr>
                      <tr >
                        <td colspan="2" style="text-align:right">
                          <button type="button" name="button" class="AjouteMedicament" onclick="AjouteMedicament()">
                            Ajoute
                            <img src="img/suivant-white.png" alt="">
                          </button>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="consulterOrdonnancelist">
                      <input type="hidden" name="idMalade" value="<?php if(isset($_GET["idMaladeConsulter"])){ echo $_GET["idMaladeConsulter"];}  ?>">
                      <table class="consulterOrdonnancetable">
                       <tr>
                         <th></th>
                          <th >Nom Medicament</th>
                          <th>Doz</th>
                          <th>Nombre Boit</th>
                        </tr>
                        <tbody  id="consulterOrdonnancelist">
                        </tbody>
                      </table>
                      <input type="submit" name="" class="AjouteMedicament" value="imprimer">
                  </div>
                </div>
              </div>
            </form>
              <div class="consulterdetail" id="Archives">
                <div class="consulterarchives">
                  <div class="consulterarchivestable">
                    <table class="consultertable">
                      <thead>
                        <tr>
                          <th>Motif</th>
                          <th>Date</th>
                          <th>medecin</th>
                          <th>Opperation</th>
                        </tr>
                      </thead>
                      <tbody>
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
                        if(isset($_GET["idMaladeConsulter"])){
                          $result=$database->query("select id_ordonnance,motif,date_format(date,'%d/%m/%Y %H:%i'),CONCAT('Dr ',nom,' ',prenom) from ordonnance join user on ordonnance.id_user=user.id_user where id_malade="
                                                 .$_GET["idMaladeConsulter"]." order by date DESC limit $debut,10 ");

                          while ($row=mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            $id=$row["id_ordonnance"]; unset($row["id_ordonnance"]);
                            foreach ($row as $key=> $value) {
                              echo "<td>".$value."</td>";
                            }
                            echo "<td><button class=\"consulterbtn\" type=\"button\" value=\"$id\"
                                    onclick=\"ConsulterOrdonnance(this.value)\">Visite</button></td>";
                            echo "</tr>";
                          }
                          }
                          ?>
                         </tbody>
                    </table>
                    <div class="tableinfo" id="tableinfo">
                      <ul class='listinfo'>
                       <?php
                       function printitem($id,$style,$get)
                       {
                          echo "<li class='$style'><a href='Consulter.php?".$get."page=$id#Archives'>$id</a></li>";
                       }
                       if(isset($_GET['page'])){
                         if($_GET['page']>1){
                             $precedant=$_GET['page']-1;
                             echo "<li class='suivprec'><a href='Consulter.php?".$get."page=$precedant#Archives'><img src='img/precedant.png'/></a></li>";
                             printitem($precedant,"listitem",$get);
                             printitem($_GET['page'],"itemactiv",$get);
                         }else{
                            echo "<li class='suivprec'><a href='Consulter.php?".$get."page=1#Archives'><img src='img/precedant.png'/></a></li>";
                           printitem(1,"itemactiv",$get);
                         }
                       }else{
                         echo "<li class='suivprec'><a href='Consulter.php?".$get."page=1#Archives'><img src='img/precedant.png'/></a></li>";
                         printitem(1,"itemactiv",$get);
                       }
                       $suivant=$page*10;
                       $result=$database->query("select id_ordonnance from ordonnance  limit $suivant ,2");

                       if(isset($_GET['page'])){$suivant=$_GET['page'];}else{$suivant=1;}
                       if(mysqli_num_rows($result)>0){
                         $suivant++;
                         printitem($suivant,"listitem",$get);
                       }
                       echo "<li class='suivprec'><a href='Consulter.php?".$get."page=$suivant#Archives'><img src='img/suivant.png'/></a></li></ul>";
                      ?>
                    </ul>
                  </div>
                  </div>
                  <div class="consulterordonnance">
                    <table class="consultertable" id="consulterordonnancetable">
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </body>
</html>
