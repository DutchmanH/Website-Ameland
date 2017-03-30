<?php require("/includes/public-header-login.html"); ?>
<?php require("/includes/dbconnect.php");

session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <title> Strandgaper Ameland - Login</title>
  <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<div class = "container"  >
<div class="row" style="\ margin-top:100px;" >


  <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.0/bootstrap.min.js"></script>

<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="text-center col-md-4 col-md-offset-4" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px;">
          <h3><b>Inloggen Strandgaper</b></h3>


          <form method="post" action="inloggen.php">
            <table>
            <tr><td><h4>Gebruikersnaam </h4></td> <td style=" border: none; border-bottom: solid 2px black; padding-top:10px; ">
              <input type="text" name="gebruikersnaam" size="30" maxlength="30" value="<?php echo isset($_POST['gebruikersnaam']) ? $_POST['gebruikersnaam'] : '' ?>" ></td></tr>

            <tr><td><h4>Wachtwoord </h4></td><td style=" border: none; border-bottom: solid 2px black; padding-top:10px; padding-right:5px;">
              <input type="password" name="wachtwoord" size="30" maxlength="30" value="<?php echo isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '' ?>"></td></tr>
          </table></br>
          <h4 style = "margin-bottom:30px;"><b><u><a href="../notactivated/wachtwoordvergeten.php" style="border-radius: 10px; padding:5px; background-color:; color:black; border-color:#008cba; ">wachtwoord vergeten</a></u></b></h4>
          <h4><b><a href="../registreren.php" style="border-radius: 10px; padding:5px; background-color:#008cba; color:black; border-color:#008cba;">registreren</a></b></h4>

            <input type="hidden" name ="hidden" >
            <h2><b><input type="submit" value="Inloggen" style="border-radius: 10px; padding:5px; background-color:#008cba; border-color:#008cba;" /></b></h2 >

        </form><br />


        <?php
        if(isset($_POST['hidden'])){
          //Ophalen van de variabelen uit het FORM en omzetten naar normale variabelen
          $gebruikersnaam = $_POST['gebruikersnaam'];
          //$hashpass = hash('sha512', $login_password);
          $wachtwoord = $hash = crypt($_POST['wachtwoord'], '$6$rounds=5000$usesomesillystringforsalt$');
          $wachtwoord = substr($wachtwoord,32,-1);


          $stmt = $db->prepare("SELECT * FROM gebruiker WHERE gebruikersnaam = ? AND wachtwoord = ? ");
          $stmt->bind_param('ss', $gebruikersnaam,$wachtwoord);

          $stmt->execute();
          $stmt->store_result();
          $num = $stmt->num_rows;
          $result = $stmt;

          if($num == 1){
              $stmt->bind_result($gebruikersnaam, $wachtwoord,$email,$id,$unlockhash,$status,$wachtwoordhash);
              while (mysqli_stmt_fetch($stmt)) {$status = $status;}
              if($status == 2){
                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['id'] = $id;
                $_SESSION['status'] = "user";

                header('location: /user/UserHome.php');
              }elseif($status == 1 ){
                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['id'] = $id;
                $_SESSION['status'] = "admin";

                header('location: /private/PrivateHome.php');
              }elseif($status == 3 ){
                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['id'] = $id;
                $_SESSION['status'] = "not_activated";

                while (mysqli_stmt_fetch($stmt)) {$email = $email;}
                echo"<div style = 'background-color:DarkGreen ; color:white; margin:10px; padding:10px; border-radius:5px;'>
                Het wachtwoord klopt <b>maar:</b>
                </div></b><br>

                <div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                Uw account is nog niet geactiveerd!<br> Er is een mail gestuurd naar <b><u>".$email."</u></b><br> met daarin een activatie link.<br> Voor u kan inloggen moet u deze eerst bevestigen<br><br>
                Klopt het email adres niet? <br><a href='/notactivated/email_veranderen.php'><b><u>verander email adres</u></b></a>
                </div></b><br>";
              }elseif($status == 0 ){
                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['id'] = $id;
                $_SESSION['status'] = "SUPER";

                header('location: /private/PrivateHome.php');
              }
                else{


              };

          }
          else{
            echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
            De combinatie gebruikersnaam wachtwoord klopt niet!

            </div></b><br>";

          };

      };
        ?>


        </div>
    </div>
</div>
</div>
</div>
</div>
  </body>
</html>
