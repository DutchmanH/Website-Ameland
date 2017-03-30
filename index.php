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
    $border_radius = 35;
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Startpagina</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>

  <body style="background-color:#e6e6e6;">
    <div class="contrainer-fluid">

      <div class="row">
        <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%; "></div>
        <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper Ameland</b></div>
      </div>

    </div>
      <div class = "container" >
      <div class="row" style="" >

        <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px; box-shadow: 10px 10px 5px #888888;"></div>

        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Het Huisje</b></h3>
          <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
            Strandgaper ligt in de duinen tussen Nes en Buren.
            Er is ruim eigen terrein bij het huis.
            De afstand van het huis tot het strand is ongeveer 500 meter.</p>
          <a href="../beschrijving.php"><b>klik hier voor een verdere beschrijving</b></a>
        </div>
      </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Foto's</b></h3>
          <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
            Strandgaper ligt in de duinen tussen Nes en Buren.
            Er is ruim eigen terrein bij het huis.
            De afstand van het huis tot het strand is ongeveer 500 meter.</p>
          <a href="../fotos.php"><b>klik hier voor meer foto's</b></a>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Locatie</b></h3>
          <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
            Strandgaper ligt in de duinen tussen Nes en Buren.
            Er is ruim eigen terrein bij het huis.
            De afstand van het huis tot het strand is ongeveer 500 meter.</p>
          <a href="../locatie.php"><b>klik hier voor de locatie</b></a>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Beschikbaarheid</b></h3>
          <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
            Strandgaper ligt in de duinen tussen Nes en Buren.
            Er is ruim eigen terrein bij het huis.
            De afstand van het huis tot het strand is ongeveer 500 meter.</p>
          <a href="../beschikbaarheid.php"><b>klik hier voor een verdere Beschikbaarheid</b></a>
          </div>
        </div>
        <div class="col-sm-4" style="margin-bottom:20px; padding:10px; background-color:#2d2b2a; border-radius: 10px; min-height:250px; box-shadow: 10px 10px 5px #888888;"><div><img src="/img/AmelandLogo.png" style="width: 100%;"></div></div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Huidige temperatuur</b></h3>
          <?php
          GETThingspeak("field1",$jsonOutputAmeland,"T",$TotalResults);
          GETThingspeak("field5",$jsonOutputAmeland,"L",$TotalResults);
            ?>

          <a href="../live.php"><b>klik hier voor meer live informatie</b></a>
          </div>
        </div>


        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Strand</b></h3>

          <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
            Strandgaper ligt in de duinen tussen Nes en Buren.
            Er is ruim eigen terrein bij het huis.
            De afstand van het huis tot het strand is ongeveer 500 meter.</p>
          <a href="../beschikbaarheid.php"><b>klik hier voor een verdere beschrijvin</b></a>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Uit eten</b></h3>
          <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
            Strandgaper ligt in de duinen tussen Nes en Buren.
            Er is ruim eigen terrein bij het huis.
            De afstand van het huis tot het strand is ongeveer 500 meter.</p>
          <a href="../beschikbaarheid.php"><b>klik hier voor een verdere beschrijving</b></a>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; min-height:250px;">
          <h3><b>Contact</b></h3>
          <p>Strandgaper is een 6 persoons vakantiehuis op Ameland.
            Strandgaper ligt in de duinen tussen Nes en Buren.
            Er is ruim eigen terrein bij het huis.
            De afstand van het huis tot het strand is ongeveer 500 meter.</p>
          <a href="../beschikbaarheid.php"><b>klik hier voor een verdere beschrijving</b></a>
          </div>
        </div>




      </div>
      <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px; box-shadow: 10px 10px 5px #888888;"></div>

      <div class="row" style="margin-top: 20px; padding:20px; background-color:#a6a6a6; border-radius: <?php echo $border_radius; ?>px; box-shadow: 10px 10px 5px #888888; margin-bottom:100px; ">
        <div class="col-sm-6" style="margin-bottom:30px;"><div><img src="/img/foto1.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style="margin-bottom:30px;"><div><img src="/img/foto2.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style="margin-bottom:20px;"><div><img src="/img/foto5.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style="margin-bottom:20px;"><div><img src="/img/foto3.jpg" style="width: 100%;"></div></div>
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
    </body>
</html>
