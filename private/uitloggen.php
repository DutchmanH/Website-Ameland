<?php session_start(); ?>
<?php require("../includes/public-header-login.html"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Uitloggen</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>

  <?php
  //zet de variabele zo dat het script het herkent als niet-ingelogd
  $_SESSION['uitgelogd'] = false;
  session_destroy();

  header( "refresh:1;url=../index.php" );
  ?>

  <div class="container container-table">
      <div class="row vertical-center-row">
          <div class="text-center col-md-4 col-md-offset-4" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px;">
            <h2> U bent nu uitgelogd. U keert nu terug naar de home pagina</h2>
          </div>
        </div>
      </div>

</body>
</html>
