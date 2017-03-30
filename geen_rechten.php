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
    <title> Strandgaper Ameland - Geen rechten</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="container container-table">
      <div class="row vertical-center-row">
          <div class="text-center col-md-4 col-md-offset-3" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px; min-width:500px;">
            <h1><b> Sorry <?php if(isset($_SESSION['gebruikersnaam'])){echo $_SESSION['gebruikersnaam'];}else{echo "gebruiker";}?>,</br></b></h1>
            <h3> U heeft geen rechten om op deze pagina te komen! </br></h3>
          </div>
        </div>
      </div>

</body>
</html>
