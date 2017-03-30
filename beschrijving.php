<?php
   session_start();
   if(isset($_SESSION['status']))
   {
     if($_SESSION['status'] == "admin" || $_SESSION['status'] == "SUPER"){require("/private/private-header.php"); $gebruikersnaam = $_SESSION['gebruikersnaam']; $id = $_SESSION['id'];}
     elseif($_SESSION['status'] == "user"){require("/user/user-header.php");$gebruikersnaam = $_SESSION['gebruikersnaam']; $id = $_SESSION['id'];}
     else{require("/includes/public-header.html");}
 }else{
     require("/includes/public-header.html");
   };
    require("/includes/functions.php");
?>


<!DOCTYPE html>
<html>
  <head>
    <title> >Over het huisje - Strandgaper Ameland </title>
  </head>
  <body style="background-color:#d9d9d9; margin-bottom:150px; ">
    <div class="contrainer-fluid">
      <div class="row">
        <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%;"></div>
        <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper Ameland - Over het huisje</b></div>
      </div>
    </div>
    <div class="container">
    <div class="row" style="" >
      <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px;"></div>
        <div class="col-md-8">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:230px;">
            <h3><b>Voorzieningen  </b></h3>
            <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
              Strandgaper ligt in de duinen tussen Nes en Buren.
              Er is ruim eigen terrein bij het huis.
              De afstand van het huis tot het strand is ongeveer 500 meter.</p>
            <a href="../aanvragen.php"><b>klik hier voor meer foto's</b></a>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:230px;">
            <h3><b>Fotos  </b></h3>
            <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
              Strandgaper ligt in de duinen tussen Nes en Buren.
              Er is ruim eigen terrein bij het huis.
              De afstand van het huis tot het strand is ongeveer 500 meter.</p>
            <a href="../aanvragen.php"><b>klik hier voor meer foto's</b></a>
          </div>
        </div>

        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:230px;">
            <h3><b>Fotos  </b></h3>
            <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
              Strandgaper ligt in de duinen tussen Nes en Buren.
              Er is ruim eigen terrein bij het huis.
              De afstand van het huis tot het strand is ongeveer 500 meter.</p>
            <a href="../aanvragen.php"><b>klik hier voor meer foto's</b></a>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:230px;">
            <h3><b>Fotos  </b></h3>
            <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
              Strandgaper ligt in de duinen tussen Nes en Buren.
              Er is ruim eigen terrein bij het huis.
              De afstand van het huis tot het strand is ongeveer 500 meter.</p>
            <a href="../aanvragen.php"><b>klik hier voor meer foto's</b></a>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:230px;">
            <h3><b>Fotos  </b></h3>
            <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
              Strandgaper ligt in de duinen tussen Nes en Buren.
              Er is ruim eigen terrein bij het huis.
              De afstand van het huis tot het strand is ongeveer 500 meter.</p>
            <a href="../aanvragen.php"><b>klik hier voor meer foto's</b></a>
          </div>
        </div>
      </div>
      <?php
      if(isset($_SESSION['status'])){
        if($_SESSION['status'] == "admin"){
          require("/private/private-footer.html");
        }elseif($_SESSION['status'] == "user"){
          require("/user/user-footer.html");
        }elseif($_SESSION['status'] == "SUPER"){
          require("/private/private-footer.html");
        }else{
          require("/includes/public-footer.html");
        };
      }else{
        require("/includes/public-footer.html");
      }
       ?>
    </div>

  </body>
</html>
