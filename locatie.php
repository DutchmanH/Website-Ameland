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
    <title> Locatie - Strandgaper Ameland</title>
  </head>
  <body style="background-color:#d9d9d9; margin-bottom:150px; ">
    <div class="contrainer-fluid">
      <div class="row">
        <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%;"></div>
        <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper Ameland - Locatie</b></div>
      </div>
      <div class = "container" >
        <div class="row" style="" >
          <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px;"></div>
          <div class="col-md-8">
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;width:100%;'><div id='gmap_canvas' style='height:440px;width:692px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:16,center:new google.maps.LatLng(53.4557465,5.788650800000028),mapTypeId: google.maps.MapTypeId.SATELLITE};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(53.4557465,5.788650800000028)});infowindow = new google.maps.InfoWindow({content:'<strong>Vakantiehuis Strandgaper</strong><br>Helmweg 21, Ameland<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

          </div>
          <div class="col-md-4" style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:440px;">
              <h3><b>De Locatie</b></h3>
              <p>De strandgaper ligt in de duinen tussen Nes en Buren. Er is ruim eigen terein bij het huisje. De afstand van het huisje tot het strand is 500 meter.
                <?PHP

                function getUserIP() {
                    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
                        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
                            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                            return trim($addr[0]);
                        } else {
                            return $_SERVER['HTTP_X_FORWARDED_FOR'];
                        }
                    }
                    else {
                        return $_SERVER['REMOTE_ADDR'];
                    }
                }


  $user_ip = getUserIP();
echo $_SERVER['HTTP_X_FORWARDED_FOR'];
echo $_SERVER['REMOTE_ADDR'];
  echo $user_ip; // Output IP address [Ex: 177.87.193.134]


  ?>

              </p>
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
  </body>
</html>
