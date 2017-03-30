<?php
   session_start();
   require("/includes/public-header.html");
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
          <div class="text-center col-md-5   col-md-offset-3" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px;">
            <h1><b> Geweldig <?php echo $_SESSION['gebruikersnaam']?>!</br></b></h1>
            <p> Het is gelukt om een  mail te sturen naar het volgende adres:<br>
              <b><u><?php echo $_SESSION['email'];?></b></u><br><br>
              <div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                LET OP!<br> De email zou bij de <b>ongewenste email</b> kunnen staan! </div></p>
          </div>
        </div>
      </div>

</body>
</html>
\
