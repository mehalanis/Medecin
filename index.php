<!DOCTYPE html>
<?php
require 'php/database.inc';
include 'php/verefieuser.php';
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/index.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1,height=device-height,">
    <link rel="stylesheet" href="css/standard.css">
    <link rel="stylesheet" href="css/NavBar.css">
    <link rel="stylesheet" href="css/SideBar.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/Mobile.css">
  </head>
  <body>
    <?php include 'html/NavBar.html';  ?>
    <div class="page">
      <?php include 'html/SideBar.html';  ?>
      <div class="contenu">
        <div class="detail">
          <div class="indexboxbtn">
            <a href="Malade.php">
              <div class="boxbtn">
                Malade
                <div class="boxbtnimage">
                  <img src="img/Malade100.png" alt="">
                </div>
              </div>
            </a>
            <a href="medicament.php">
              <div class="boxbtn">
                Medicament
                <div class="boxbtnimage">
                  <img src="img/medicament100.png" alt="">
                </div>
              </div>
            </a>
            <a href="user.php">
              <div class="boxbtn">
                Réglage
                <div class="boxbtnimage">
                  <img src="img/setting100pxwhite.png" alt="">
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
