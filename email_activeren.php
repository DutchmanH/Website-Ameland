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
    require("/includes/dbconnect.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Email geactiveerd</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="container container-table">
      <div class="row vertical-center-row">
          <div class="text-center col-md-4 col-md-offset-4" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px; min-width:400px;">

          <?php
          $unlockhashURL = $_GET['unlockcode'];
          $gebruikersnaamURL = $_GET['gebruikersnaam'];
          echo"<h3><b>Welkom $gebruikersnaamURL</b></h3>";
          $result = $db->query("SELECT * FROM gebruiker WHERE gebruikersnaam = '".$gebruikersnaamURL."' and unlockhash = '".$unlockhashURL."'");
          $num = $result->num_rows;
          //echo "SELECT * FROM gebruiker WHERE gebruikersnaam = '".$gebruikersnaamURL."' and unlockhash = '".$unlockhashURL."'";



          if($num == 1){

            $result = $db->query("UPDATE gebruiker SET Status = 2 WHERE gebruikersnaam = '".$gebruikersnaamURL."'");

            if($result){
              echo"<div style = 'background-color:DarkGreen ; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Gelukt! Uw account is ontgrendeld u kunt nu inloggen.
              </div></b><br>
              <div style = 'background-color:#008cba; color:black; margin:10px; padding:10px; border-radius:5px;'>
              <b><a style = 'color:white;'href='inloggen.php'>Inloggen</a></div></b>";
            }else{
              echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Er is iets fout gegaan vraag de systeembeheerder om hulp!
              </div></b><br>";

            };

          }
          else{
            echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
            Uw account kan niet worden ontgrendeld :(

            </div></b><br>";

          };
          ?>

          </div>
        </div>
      </div>

</body>
</html>
