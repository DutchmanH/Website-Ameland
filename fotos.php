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
    <title> Foto's - Strandgaper Ameland</title>
  </head>
  <body style="background-color:#d9d9d9; margin-bottom:150px; ">
    <div class="contrainer-fluid">
      <div class="row">
        <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%;"></div>
        <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper Ameland - Foto's</b></div>
      </div>
    </div>
    <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px;"></div>
    <div class="row" style="margin-top: 20px; padding:20px; background-color:#a6a6a6; border-radius: 10px; margin-bottom:100px; ">

        <div class="col-sm-6" style=""><div><img src="/img/foto1.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/foto2.jpg" style="width: 100%;"></div></div>


        <div class="col-sm-6" style=""><div><img src="/img/foto5.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/foto3.jpg" style="width: 100%;"></div></div>


        <div class="col-sm-6" style=""><div><img src="/img/photo13.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/photo11.jpg" style="width: 100%;"></div></div>


        <div class="col-sm-6" style=""><div><img src="/img/photo12.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/photo10.jpg" style="width: 100%;"></div></div>

        <div class="col-sm-6" style=""><div><img src="/img/photo26.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/photo15.jpg" style="width: 100%;"></div></div>

        <div class="col-sm-6" style=""><div><img src="/img/photo21.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/photo22.jpg" style="width: 100%;"></div></div>

        <div class="col-sm-6" style=""><div><img src="/img/photo23.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/photo24.jpg" style="width: 100%;"></div></div>

        <div class="col-sm-6" style=""><div><img src="/img/photo25.jpg" style="width: 100%;"></div></div>
        <div class="col-sm-6" style=""><div><img src="/img/photo14.jpg" style="width: 100%;"></div></div>

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
