<?php session_start(); ?>
<?php require("../private/private-header.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Private Account</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="contrainer-fluid">

    <div class="row">
      <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%; "></div>
      <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Beschikbaarheid <?php echo $_SESSION['gebruikersnaam'];?></b></div>
    </div>
    <?php
    if($_SESSION['status'] == "admin"){
      require("../private/private-footer.html");
    }elseif($_SESSION['status'] == "user"){
      require("../user/user-footer.html");
    }elseif($_SESSION['status'] == "SUPER"){
      require("../private/private-footer.html");
    }else{
      require("../includes/public-footer.html");
    };
     ?>
  </div>

    </body>
</html>



  </body>
</html>
