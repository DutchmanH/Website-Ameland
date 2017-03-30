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
    <title> Strandgaper Ameland - Registreren Gelukt</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="container container-table">
      <div class="row vertical-center-row">
          <div class="text-center col-md-5 col-md-offset-3" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px;">
            <h1><b> Geweldig <?php echo $_SESSION['gebruikersnaam']?>!</br></b></h1>
            <p> Het is gelukt om uw account aan te maken!<br>
              Er is een mail gestuurd naar het email adres <b><u><?php echo $_SESSION['email'];?></b></u><br>
               met daarin een bevestiging! Als u deze heeft geactiveerd heeft u toegang tot uw account<br><br>
               <div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                 LET OP!<br> De email zou bij de <b>ongewenste email</b> kunnen staan! </div></p>
          </div>
        </div>
      </div>

</body>
</html>
\
