<?php

//require_once('TCPDF/tcpdf.php');
require_once('TCPDF/tcpdf_import.php');
session_start();
require 'php/database.inc';
if(isset($_POST["idMalade"])){
$idMalade=$_POST["idMalade"];
unset($_POST["idMalade"]);
$database=new database();
$result=$database->query("select region.nom as region from user join region on user.id_region = region.id_region where id_user="
                                                                                                       .$_SESSION["id_user"]);
$row=mysqli_fetch_assoc($result);
$region_user=$row["region"];

$result=$database->query("select nom,prenom,year(date_naissance) as ans from malade where id_malade=".$idMalade);
$row=mysqli_fetch_assoc($result);
$age=date("Y")-$row["ans"];

$result=$database->query("insert into ordonnance(id_malade,id_user,motif,date) values (".$idMalade." , "
                       .$_SESSION['id_user']." ,'".$_POST['motif']."',timestamp(now()))");
$idordonnance=$database->insertid();



$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A5", true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins("15", "0", PDF_MARGIN_RIGHT);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('times', 'BI', 15);


$pdf->AddPage();

$pdf->SetXY(0, 0);
$pdf->Image('img/ord.JPG', '', '', 145, 72, '', '', 'T', false, 400, '', false, false,0, false, false, false);


$pdf->SetY(21,true,false);
$pdf->SetX(75,false);
$pdf->writeHTML("<label>".$row["nom"]."</label>", true, false, true, false, '');

$pdf->SetY(30,true,false);
$pdf->SetX(75,false);
$pdf->writeHTML("<label>".$row["prenom"]."</label>", true, false, true, false, '');

$pdf->SetY(38.5,true,false);
$pdf->SetX(75,false);
$pdf->writeHTML("<label>".$age."</label>", true, false, true, false, '');

$pdf->SetY(61,true,false);
$pdf->SetX(16,false);
$pdf->writeHTML("<label>".$region_user."</label>", true, false, true, false, '');

$date= date("d/m/Y");

$pdf->SetY(61,true,false);
$pdf->SetX(45,false);
$pdf->writeHTML("<label>$date</label>", true, false, true, false, '');


$pdf->SetX(14,false);
$pdf->SetY(74,true,false);

$txt ="<table cellpadding=\"3\" >";

foreach ($_POST["nom"] as $k => $v) {
  $result=$database->query("select id_medicament from medicament where nom_medicament='".$_POST["nom"][$k]."'");
  if(mysqli_num_rows($result)>0){
  	$row=mysqli_fetch_assoc($result);
  	$idmedicament=$row["id_medicament"];
  }else{
  	$result=$database->query("insert into medicament(nom_medicament) values ('".$_POST["nom"][$k]."') ");
  	$idmedicament=$database->insertid();
  }
  $result=$database->query("insert into traitement values (".$idordonnance.",".$idmedicament.",'".$_POST["doz"][$k]."',".$_POST["nbrboit"][$k].")");


	$txt.="<tr><td width=\"50\">".$_POST["nbrboit"][$k]."</td><td width=\"250\">".$_POST["nom"][$k]."</td><td>".$_POST["doz"][$k]."</td></tr>";
}
$txt.="</table>";

$pdf->writeHTML($txt, true, false, true, false, '');

$pdf->Output('example_002.pdf', 'I');

}
?>
