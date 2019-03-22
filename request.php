<?php

if(isset($_GET["idOrdonnance"])){
  include 'php/JsonOrdnnance.php';
  LoadOrdonnance($_GET["idOrdonnance"]);
}
?>
