<?php session_start();
 require("/includes/public-header-login.html"); ?>
<?php require("/includes/dbconnect.php");?>
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
        <div class="text-center col-md-4 col-md-offset-4" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px; min-width:400px;">
          <h3><b>Registreren Strandgaper</b></h3>
          <form method="post" action="registreren.php">
            <table>
            <tr><td><h4>Gebruikersnaam: </h4></td> <td style=" border: none; border-bottom: solid 2px black; padding-top:10px;">
              <input type="text" name="gebruikersnaam" size="30" maxlength="30" value="<?php echo isset($_POST['gebruikersnaam']) ? $_POST['gebruikersnaam'] : '' ?>"></td></tr>

            <tr><td><h4>Email: </h4></td> <td style=" border: none; border-bottom: solid 2px black; padding-top:10px;">
              <input type="text" name="email" size="30" maxlength="40" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"></td></tr>

            <tr><td><h4>Wachtwoord: </h4></td><td style=" border: none; border-bottom: solid 2px black; padding-top:10px;">
              <input type="password" name="wachtwoord1" size="30" maxlength="30" value="<?php echo isset($_POST['wachtwoord1']) ? $_POST['wachtwoord1'] : '' ?>"></td></tr>

            <tr><td><h4>Wachtwoord: </h4></td><td style=" border: none; border-bottom: solid 2px black; padding-top:10px;">
              <input type="password" name="wachtwoord2" size="30" maxlength="30" value="<?php echo isset($_POST['wachtwoord2']) ? $_POST['wachtwoord2'] : '' ?>"></td></tr>
          </table></br>
            <input type="hidden" name ="hidden" >
            <b><input type="submit" value="Registreren" style="border-radius: 10px; padding:5px; background-color:#008cba; border-color:#008cba; font-size: 200%" /></b>
        </form><br>

        <?php
        if(isset($_POST['hidden'])){
          $invulfout1 = "";
          $invulfout2 = "";
          $invulfout3 = "";
          $errorcount = 0;
          $errorcount2 = 0;
          //Query die checkt of gebruikersnaam wachtwoord klopt
          if($_POST['gebruikersnaam']!=""){
            $result = $db->query("SELECT * FROM gebruiker WHERE gebruikersnaam='".$_POST['gebruikersnaam']."'");
            $num = $result->num_rows;   //kijken hoeveel resultaten er terug gegeven worden

            // Als er een uitkomst is bij de query betekend dat dat de gebruikersnaam als in de database voor komt
            if($num == 0){
            }else{
              $errorcount2 += 1;
              echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Deze gebruikersnaam is al in gebruik!</div></br>";
            }
          }else{
            $invulfout1 = " [Gebruikersnaam] ";
            $errorcount += 1;
          };
          if($_POST['email'] != ""){
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
              $errorcount2 += 1;
              echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Het email adres is niet correct ingevuld!</div></b><br>";
            }

          }else{
            $invulfout2 = " [Email] ";
            $errorcount += 1;
          }
          if($_POST['wachtwoord1'] != "" || $_POST['wachtwoord2'] != ""){
              if($_POST['wachtwoord1'] != $_POST['wachtwoord2']){
                $errorcount2 += 1;
                echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
              De twee wachtwoorden komen niet overeen!</div></b><br>";
              }
          }else{
            $invulfout3 = " [Wachtwoord] ";
            $errorcount += 1;
          }
          if($errorcount != 0){
            echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
            Je hebt de velden:<b>".$invulfout1.$invulfout2.$invulfout3." niet ingevuld.

            </div></b><br>";
          }


          if($errorcount == 0 && $errorcount2 == 0){
              $gebruikersnaam = $_POST['gebruikersnaam'];

              $email = $_POST['email'];

              $wachtwoord = $_POST['wachtwoord1'];
              $wachtwoord = crypt($wachtwoord, '$6$rounds=5000$usesomesillystringforsalt$');//sha512
              $wachtwoord = substr($wachtwoord,32,-1);

              function generateRandomString($length = 50) {return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);};
              $randomStringUnlock = generateRandomString();
              $randomStringWW = generateRandomString();
              $unlockCode = crypt($randomStringUnlock, '$6$rounds=5000$usesomesillystringforsalt$');//sha512
              $unlockCode = substr($unlockCode,32,-1);
              $wachtwoordhash = crypt($randomStringWW, '$6$rounds=5000$usesomesillystringforsalt$');//sha512
              $wachtwoordhash = substr($wachtwoordhash,32,-1);

              $stmt = $db->prepare("INSERT INTO `gebruiker` (`gebruikersnaam`, `wachtwoord`, `email`, `id`, `unlockhash`, `status`,`wachtwoordhash`) VALUES (?,?,?,NULL,?,3,?)");
              $stmt->bind_param('sssss', $gebruikersnaam,$wachtwoord,$email,$unlockCode,$wachtwoordhash);
              $stmt->execute();

              //versturen van Email
              $to = $email;
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

              $_SESSION['email'] = $email;
              $_SESSION['gebruikersnaam'] = $gebruikersnaam;
              $_SESSION['status'] = "not_activated";

              echo "<meta http-equiv='refresh' content='0;url=http://127.0.0.1/registreren_gelukt.php/'>";
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
