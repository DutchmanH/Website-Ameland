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
    require("/includes/dbconnect.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Wachtwoord Check</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="container container-table">
      <div class="row vertical-center-row">
          <div class="text-center col-md-5 col-md-offset-3" style="background-color:grey; margin-top:100px; border-radius: 10px; min-height: 230px; min-width:400px;">

          <?php
          $unlockwachtwoordURL = $_GET['unlockwachtwoord'];
          $gebruikersnaamURL = $_GET['gebruikersnaam'];


          $stmt = $db->prepare("SELECT wachtwoordhash FROM gebruiker where gebruikersnaam = ?");
          $stmt->bind_param('s', $gebruikersnaamURL);
          $stmt->execute();
          $stmt->bind_result($unlockwachtwoord);
          $stmt->fetch();
          $stmt->close();

          if($unlockwachtwoord == $unlockwachtwoordURL){
            $_SESSION['gebruikersnaam'] = $gebruikersnaamURL;

            echo"<h3><b>Beste  $gebruikersnaamURL</b></h3>
            <p>U kan hier uw wachtwoord verandren door in beide vakken twee  maal hetzelfde nieuwe wachtwoord in te vullen, waarna u vervolgens op wachtwoord veranderen kan klikken.</p>
            <form method='post' action='wachtwoord_check.php?unlockwachtwoord=".$unlockwachtwoord."&gebruikersnaam=".$gebruikersnaamURL."'>
              <table>
                <tr><td><h4>Wachtwoord </h4></td> <td style=' border: none; border-bottom: solid 2px black; padding-top:10px; '>
                <input type='password' name='wachtwoord1' size='30' maxlength='30' value='";if(isset($_POST['wachtwoord1'])){echo $_POST['wachtwoord1'];}; echo"' ></td></tr>
                <tr><td><h4>Wachtwoord </h4></td><td style=' border: none; border-bottom: solid 2px black; padding-top:10px; padding-right:5px;'>
                <input type='password' name='wachtwoord2' size='30' maxlength='30' value='";if(isset($_POST['wachtwoord2'])){echo $_POST['wachtwoord2'];}; echo"' ></td></tr>
              </table></br>

              <input type='hidden' name ='hidden' >
              <h3><b><input type='submit' value='Wachtwoord veranderen  ' style='border-radius: 10px; padding:5px; background-color:#008cba; border-color:#008cba;' /></b></h3 >
              </form>";
              if(isset($_POST['hidden'])){
                //Ophalen van de variabelen uit het FORM en omzetten naar normale variabelen
                $fouten = 0;
                $wachtwoord1 = $_POST['wachtwoord1'];
                $wachtwoord2 = $_POST['wachtwoord2'];
                if($_POST['wachtwoord1'] != "" ||  $_POST['wachtwoord2'] != ""){
                }else{
                  echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                  U heeft de velden niet ingevuld!
                  </div></b><br>";
                  $fouten += 1;
                }
                if($wachtwoord1 == $wachtwoord2){
                }else{
                  echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                  De twee wachtwoorden komen niet overeen.
                  </div></b><br>";
                  $fouten += 1;
                }
                if($fouten == 0){

                  $UpdateWachtwoord = crypt($wachtwoord1, '$6$rounds=5000$usesomesillystringforsalt$');//sha512
                  $UpdateWachtwoord = substr($UpdateWachtwoord,32,-1);

                  $stmt = $db->prepare("UPDATE gebruiker SET wachtwoord = ? where gebruikersnaam = ?");
                  $stmt->bind_param('ss', $UpdateWachtwoord,$gebruikersnaamURL);
                  $stmt->execute();
                  echo"UPDATE gebruiker SET wachtwoord = $UpdateWachtwoord WHERE gebruikersnaam = $gebruikersnaamURL";
                  echo "gelukt!";
                }
              };
          }
          else{
            echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
            <h3>Beste ".$gebruikersnaamURL.",</h3><br>Uw wachtwoord kan niet worden veranderd!<br> Als u wel een mail heeft gekregen en u heeft wel op de bijgevoegde link geklik maar toch krijgt u dit bericht, meld dit dat bij de systeembeheerder.

            </div></b><br>";

          };
          ?>

          </div>
        </div>
      </div>

</body>
</html>
