<?php
if($_SESSION['status'] != "user" && $_SESSION['status'] != "admin" && $_SESSION['status'] != "SUPER ADMIN"){
  header("Location: http://127.0.0.1/geen_rechten.php");
  die();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale1.0">
    <link href = "../css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../css/bootstrap.css" rel = "stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <nav class="navbar navbar-default navbar-static-top" style="padding-top:10px; padding-bottom:10px; background-color:#222222; margin-bottom: 0px; position:fixed; width :100%;">
   <div class"container">
     <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="../user/UserHome.php" style="font-size:350%;">Strandgaper</a><div style="float:down; color:white; padding-left:20px; "><?php echo $_SESSION['gebruikersnaam'];?></div>
     </div>
     <div class="collapse navbar-collapse" id="mynavbar">
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="../index.php">Home page</a></li>
       </ul>
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="../beschrijving.php">Over het huisje</a></li>
       </ul>
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="..//fotos.php">Foto's</a></li>
       </ul>
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="..//locatie.php">Locatie</a></li>
       </ul>
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="..//beschikbaarheid.php">Beschikbaarheid</a></li>
       </ul>
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="..//live.php">Live</a></li>
       </ul>
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="..//contact.php">Contact</a></li>
       </ul>
       <ul class="nav navbar-nav" style="font-size:130%; ">
         <li><a href="../user/Account.php">Account</a></li>
       </ul>
       <ul class="nav navbar-nav" style="float:right; margin-right:10px; ">
         <button onclick="location.href = '../private/uitloggen.php';" type="button" class="btn btn-primary navbar-btn"style="font-size:130%; background-color:DarkRed; border-radius: 10px;" >Uitloggen</button>
       </ul>
     </div>
   </div>
  </nav>
  <style>
  .info {
      position: relative;
      display: inline-block;
  }
  .info .meerinfo {
      visibility: hidden;
      width: 280px;
      background-color:#2d2b2a;
      color: #fff;
      margin-left:5px;
      border-radius: 10px;
      padding: 15px 0;
      padding-left:10px;


      /* Position the tooltip */
      position: absolute;
      z-index: 1;
  }
  .info:hover .meerinfo {
    visibility: visible;
  }
  </style>
</html>
