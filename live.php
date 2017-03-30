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
    <title> >Strandgaper Ameland - Live</title>
  </head>
  <body style="background-color:#d9d9d9; margin-bottom:150px; ">
    <div class="contrainer-fluid">
      <div class="row">
        <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%;"></div>
        <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper Ameland - Live</b></div>
      </div>
    </div>
    <div class = "container" >
      <div class="row" style="" >

        <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px; box-shadow: 10px 10px 5px #888888;"></div>

        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:220px; box-shadow: 10px 10px 5px #888888;">
          <h3><b>Woonkamer</b></h3>
            <?php
              GETThingspeak("field1",$jsonOutputAmeland,"T",$TotalResults);
              GETThingspeak("field2",$jsonOutputAmeland,"L",$TotalResults);
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:220px; box-shadow: 10px 10px 5px #888888;">
          <h3><b>Sensoren</b></h3>
          De strandgaper heeft een paar sensoren in en rondom het huis staan
          Deze sensoren houden onder andere bij wat de Temperatuur, Luchtvochtigheid, Windsnelheid en Windrichting is.
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:220px; box-shadow: 10px 10px 5px #888888;">
          <h3><b>Gang</b></h3>
            <?php
              GETThingspeak("field5",$jsonOutputAmeland,"T",$TotalResults);

              GETThingspeak("field6",$jsonOutputAmeland,"L",$TotalResults);
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:220px; box-shadow: 10px 10px 5px #888888;">
          <h3><b>Buiten</b></h3>
            <?php
              GETThingspeak("field1",$jsonOutputAmeland2,"T",$TotalResults);
              GETThingspeak("field2",$jsonOutputAmeland2,"L",$TotalResults);
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:220px; box-shadow: 10px 10px 5px #888888;">
          <h3><b>Sensoren</b></h3>
          De strandgaper heeft een paar sensoren in en rondom het huis staan
          Deze sensoren houden onder andere bij wat de Temperatuur, Luchtvochtigheid, Windsnelheid en Windrichting is.

          </div>
        </div>
        <div class="col-md-4">
          <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:220px; box-shadow: 10px 10px 5px #888888;">
          <h3><b>Wind</b></h3>
            <?php
              GETThingspeak("field5",$jsonOutputAmeland2,"WR",$TotalResults);
              GETThingspeak("field6",$jsonOutputAmeland2,"WS",$TotalResults);
            ?>
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
