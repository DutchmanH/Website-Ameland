<?php
   session_start();
    require("../includes/public-header.html");
    require("../includes/dbconnect.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Wachtwoord veran </title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="container container-table">
      <div class="row vertical-center-row">

          <div class="text-center col-md-4 col-md-offset-3" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px; min-width:500px;">
            <h1><b>Wachtwoord herstellen  </br></b></h1>
            <p> Als je je wachtwoord niet meer weet kan je deze hier veranderen. <br> Het enige wat wij van u moeten weten is het email adres en de gebruikersnaam.
              Als deze gegevens kloppen sturen wij een mail naar uw email adres waarna u uw wachtwoord kan herstellen.<br><br>
                <form method="post" action="wachtwoordvergeten.php">
                  <table>
                  <tr><td><h4>Email adres </h4></td> <td style=" border: none; border-bottom: solid 2px black; padding-top:10px; ">
                    <input type="text" name="inputemail" size="30" maxlength="30" value="<?php echo isset($_POST['inputemail']) ? $_POST['inputemail'] : '' ?>" ></td></tr>
                  <tr><td><h4>gebruikersnaam </h4></td> <td style=" border: none; border-bottom: solid 2px black; padding-top:10px; ">
                    <input type="text" name="inputgebruikersnaam" size="30" maxlength="30" value="<?php echo isset($_POST['inputgebruikersnaam']) ? $_POST['inputgebruikersnaam'] : '' ?>" ></td></tr>

                </table></br>
                  <input type="hidden" name ="hidden" >
                  <h2><b><input type="submit" value="Herstellen" style="border-radius: 10px; padding:5px; background-color:#008cba; border-color:#008cba;" /></b></h2 >
              </form><br/>
              <?php
              if(isset($_POST['hidden'])){
                if($_POST['inputgebruikersnaam'] != ""){
                }else{
                  echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                  Er is geen gebruikersnaam ingevuld</div></b><br>";
                }
                if($_POST['inputemail'] != ""){

                  if (!filter_var($_POST['inputemail'], FILTER_VALIDATE_EMAIL)) {
                    echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                    Het email adres is niet correct ingevuld!</div></b><br>";
                  };
                }else{
                  echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                  Er is geen Email adres ingevuld</div></b><br>";
                };
                if($_POST['inputemail'] != "" && $_POST['inputgebruikersnaam'] != ""){

                    $inputemail = $_POST['inputemail'];
                    $inputgebruikersnaam = $_POST['inputgebruikersnaam'];
                    $stmt = $db->prepare("SELECT gebruikersnaam FROM gebruiker where gebruikersnaam = ?");
                    $stmt->bind_param('s', $inputgebruikersnaam);
                    $stmt->execute();
                    $stmt->bind_result($gebruikersnaam);
                    $stmt->fetch();
                    $stmt->close();

                    $stmt = $db->prepare("SELECT email FROM gebruiker where gebruikersnaam = ?");
                    $stmt->bind_param('s', $inputgebruikersnaam);
                    $stmt->execute();
                    $stmt->bind_result($email);
                    $stmt->fetch();
                    $stmt->close();

                    if(strtolower ($inputemail) == strtolower ($email) && strtolower ($inputgebruikersnaam) == strtolower ($gebruikersnaam) ){
                      $stmt = $db->prepare("SELECT wachtwoordhash FROM gebruiker where gebruikersnaam = ?");
                      $stmt->bind_param('s', $gebruikersnaam);
                      $stmt->execute();
                      $stmt->bind_result($wachtwoordhash);
                      $stmt->fetch();
                      $stmt->close();

                      $to = $inputemail;
                      $subject = "Wachtwoord herstellen ".$gebruikersnaam."";

                      $txt = "
                      <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
            <title>Strandgaper email</title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
            </head>
            <body style='margin: 0; padding: 0;'>
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td style='padding: 10px 0 30px 0;'>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border: 1px solid #cccccc; border-collapse: collapse;'>
                    <td align='center' bgcolor='#222222' style='padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
                      <a href='http://127.0.0.1/index.php'><div style='font-size:150%; color:white; float:left; padding-left:20px;'> Strandgaper</div><div style='font-size:50%; color:white; float:left; padding-left:10px; padding-top:40px;'> Ameland</div></a>
                    </td>
                      </tr>
                      <tr>
                        <td bgcolor='#ffffff' style='padding: 40px 30px 40px 30px;'>
                          <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                            <tr>
                              <td style='color: #153643; font-family: Arial, sans-serif; font-size: 24px;'>
                                <b>Welkom bij de Strandgaper ".$gebruikersnaam.",</b>
                              </td>
                            </tr>
                            <tr>
                              <td style='padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                              U heeft bij ons aangegeven dat u uw wachtwoord bent vergeten. Gelukkig kan u deze via onderstaande link opnieuw aanvragen</br>
                              <b><u><a href='http://127.0.0.1/wachtwoord_check.php?unlockwachtwoord=".$wachtwoordhash."&gebruikersnaam=".$gebruikersnaam."'>Klik hier om het wachtwoord te herstellen</a></u></b></br></br>
                              Met vriendelijke groet,</br></br>
                              De Strandgaper
                              </td>
                            </tr>

                          </table>
                        </td>
                      </tr>
                      <td align='center' bgcolor='#222222' style='padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
                        <div style='font-size:50%; color:white; float:right; padding-right:20px;'> Martijn Dijkstra</div>
                      </td>
                    </table>
                  </td>
                </tr>
              </table>
            </body>
            </html>
                      ";
                      $headers = "From: Vakantiehuis@Strandgaper.nl" . "\r\n";
                      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                      mail($to,$subject,$txt,$headers);

                      $_SESSION['email'] = $email;
                      $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                      echo "<meta http-equiv='refresh' content='0;url=http://127.0.0.1/wachtwoordversturen_gelukt.php'>";

                    }else{
                      if($email == $inputemail){echo"<br>input email en mail kloppen wel";}
                      if($gebruikersnaam == $inputgebruikersnaam){echo"<br>input gebruikersnaam en gebruikersnaam kloppen wel";}
                      echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                      Combinatie gebruikersnaam wachtwoord klopt niet!</div></b><br>";
                  }
                  }
              };
              ?>
          </div>



        </div>
      </div>

</body>
</html>
