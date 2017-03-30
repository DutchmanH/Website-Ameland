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
    <title> >Strandgaper Ameland - Beschikbaarheid</title>
  </head>
  <body style="background-color:#d9d9d9; margin-bottom:150px; ">
    <div class="contrainer-fluid">
      <div class="row">
        <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%;"></div>
        <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px; "><b>Strandgaper Ameland - Beschikbaarheid</b></div>
      </div>
      <div class="row" style="" >
        <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px; box-shadow: 10px 10px 5px #888888;"></div>


        <div class="col-md-8">

          <iframe src="https://www.homeaway.nl/vakantiewoning/p1007570#amenities" style="height:400px; width:100%" scrolling="no"></iframe>

        </div>
        <div class="col-md-4" style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:440px; box-shadow: 10px 10px 5px #888888;">
            <h3><b>Beschikbaarheid</b></h3>
            <p>bla bla bla</p>
            <a href="https://www.homeaway.nl/vakantiewoning/p1007570"><b>klik hier voor een verdere beschrijving</b></a>
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
