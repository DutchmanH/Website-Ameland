<?php session_start(); ?>
<?php require("../private/private-header.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Private Home</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="contrainer-fluid">

    <div class="row">
      <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%; "></div>
      <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper-Admin</b></div>
    </div>

  </div>
    <div class = "container" >
    <div class="row" style="" >

      <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px;"></div>

      <div class="col-md-4">
        <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <h3><b>Announcements</b></h3>
        <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
          Strandgaper ligt in de duinen tussen Nes en Buren.
          Er is ruim eigen terrein bij het huis.
          De afstand van het huis tot het strand is ongeveer 500 meter.</p>
        <a href="../private/bericht.php"><b>klik hier om een bericht te maken</b></a>
      </div>
    </div>
      <div class="col-md-4">
        <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <h3><b>Beschikbaarheid</b></h3>
        <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
          Strandgaper ligt in de duinen tussen Nes en Buren.
          Er is ruim eigen terrein bij het huis.
          De afstand van het huis tot het strand is ongeveer 500 meter.</p>
        <a href="../private/Beschikbaarheid.php"><b>klik hier om de beschikbaarheid aan te passen</b></a>
        </div>
      </div>
      <div class="col-md-4">
        <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <h3><b>Statistieken</b></h3>
        <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
          Strandgaper ligt in de duinen tussen Nes en Buren.
          Er is ruim eigen terrein bij het huis.
          De afstand van het huis tot het strand is ongeveer 500 meter.</p>
        <a href="../private/Statistieken.php"><b>klik hier voor de statistieken</b></a>
        </div>
      </div>
      <div class="col-md-4">
        <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <h3><b>Account</b></h3>
        <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
          Strandgaper ligt in de duinen tussen Nes en Buren.
          Er is ruim eigen terrein bij het huis.
          De afstand van het huis tot het strand is ongeveer 500 meter.</p>
        <a href="../private/Account.php"><b>klik hier om jou account te zien</b></a>
        </div>
      </div>
      <div class="col-md-4">
        <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <h3><b>To Do list Ameland</b></h3>
        <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
          Strandgaper ligt in de duinen tussen Nes en Buren.
          Er is ruim eigen terrein bij het huis.
          De afstand van het huis tot het strand is ongeveer 500 meter.</p>
        <a href="../private/ToDo.php"><b>klik hier voor de huidige To Do list</b></a>
        </div>
      </div>
    </div>
    <?php
    if($_SESSION['status'] == "admin"){
      require("../private/private-footer.html");
    }elseif($_SESSION['status'] == "user"){
      require("../user/user-footer.html");
    }elseif($_SESSION['status'] == "SUPER"){
      require("../private/private-footer.html");
    }else{
      require("../includes/public-footer.html");
    };
     ?>
  </div>






  </body>
</html>
