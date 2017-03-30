<?php
   session_start();
    require("../includes/public-header.html");
    require("../includes/dbconnect.php");
    $id = $_SESSION['id'];
    $stmt = $db->prepare("SELECT email FROM gebruiker where id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();
    $_SESSION['email'] = $email;
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
          <div class="text-center col-md-4 col-md-offset-3" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px; min-width:500px;">
            <h1><b> Hoi <?php echo $_SESSION['gebruikersnaam']?>!</br></b></h1>
            <p> Als je een verkeerd email adres hebt ingevuld kan je deze hier veranderen in je huidige email adres.<br><br>
              Er is wel een mail gestuurd naar het email adres <br>
            <b><u><?php echo $_SESSION['email'];?></b></u><br> Als dit adres niet klopt vul hieronder dan jouw goeie adres in en er word een nieuwe mail gestuurd</p>
          </div>
          <div class="text-center col-md-4 col-md-offset-3" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px; min-width:500px;">
            <h1><b> Email adres veranderen</br></b></h1>
                <form method="post" action="email_veranderen.php">
                  <table>
                  <tr><td><h4>Nieuw email adres: </h4></td> <td style=" border: none; border-bottom: solid 2px black; padding-top:10px; ">
                    <input type="text" name="nieuwEmail" size="30" maxlength="50" value="<?php echo isset($_POST['nieuwEmail']) ? $_POST['nieuwEmail'] : '' ?>" ></td></tr>
                </table></br>
                  <input type="hidden" name ="hidden" >
                  <h2><b><input type="submit" value="Veranderen" style="border-radius: 10px; padding:5px; background-color:#008cba; border-color:#008cba;" /></b></h2 >
              </form><br/>
              <?php
              if(isset($_POST['hidden'])){

                if($_POST['nieuwEmail'] != ""){
                  if (!filter_var($_POST['nieuwEmail'], FILTER_VALIDATE_EMAIL)) {
                    echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                    Het email adres is niet correct ingevuld!</div></b><br>";
                  }else{
                      $nieuwEmail = $_POST['nieuwEmail'];
                      $gebruikersnaam = $_SESSION['gebruikersnaam'];
                      $id = $_SESSION['id'];
                      $unlockCode = "";
                      $stmt = $db->prepare("SELECT unlockhash FROM gebruiker where id = ?");
                      $stmt->bind_param('i', $id);
                      $stmt->execute();
                      $stmt->bind_result($unlockCode);
                      $stmt->fetch();
                      $stmt->close();

                      $stmt = $db->prepare("UPDATE gebruiker SET email = ? where id = ?");
                      $stmt->bind_param('si', $nieuwEmail,$id);
                      $stmt->execute();

                      $to = $nieuwEmail;
                      $subject = "Activatie Link Account";
      
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
                              Beste ".$gebruikersnaam.",</br></br>
                              Je registratie is succesvol voltooid! Om deze af te ronden moet je op de volgende link klikken.</br>
                              <b><u><a href='http://127.0.0.1/email_activeren.php?unlockcode=".$unlockCode."&gebruikersnaam=".$gebruikersnaam."'>Klik om te activeren</a></u></b></br></br>
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

                      $_SESSION['email'] = $nieuwEmail;

                      echo "<meta http-equiv='refresh' content='0;url=http://127.0.0.1/notactivated/registreren_gelukt.php'>";
                  }
                }else{
                  echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                  Er is geen adres ingevuld</div></b><br>";
                };




            };
              ?>
          </div>



        </div>
      </div>

</body>
</html>
