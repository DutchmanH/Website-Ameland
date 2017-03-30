<?php session_start();
require("../user/user-header.php"); ?>
<?php require("../includes/dbconnect.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Private Account</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
<div class="row">
  <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%; "></div>
  <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Welkom <?php echo $_SESSION['gebruikersnaam'];?></b></div>
</div>
<div class = "container" >
  <div class="col-md-3">

  </div>
  <div class="col-md-6">
    <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <?php
        $id = $_SESSION['id'];
        $get_query = $con->query("SELECT gebruikersnaam FROM gebruiker WHERE id = ".$id."");
        $show_row = mysqli_fetch_array($get_query);
        $gebruikerDatabase = $show_row;
        $get_query2 = $con->query("SELECT email FROM gebruiker WHERE id = ".$id."");
        $show_row2 = mysqli_fetch_array($get_query2);
        $emailDatabase = $show_row2;
        ?>
        <style>
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }
        </style>
      <form method='post' action='Account.php'>
        <table style="border-collapse: collapse; width: 100%;">

            <tr style = "margin:10px;">
              <td>ID</td><td><?php echo $id;?></td>
            </tr>
          <tr>
            <td>Naam</td><td><?php echo $gebruikerDatabase[0];?></td>
            <td><input type="text" name='inputNaam' style="width:100%;" value ="<?php echo $gebruikerDatabase[0]; ?>"></></td>
            <td><input type ="submit" name="aanpasNaam" value="Aanpassen"></></b></td></td>
          </tr>
          <tr>
            <td>Email</td><td><?php echo $emailDatabase[0];?></td>
            <td><input type="text" name='inputEmail' style="width:100%;"  value ="<?php echo $emailDatabase[0]; ?>"></></td>
            <td><input type ='submit' name='aanpasEmail' value='Aanpassen'></b></td></td>
          </tr>
          <tr>
            <td>Wachtwoord</td><td></td>
            <td><input type="text" name='inputWachtwoord'style="width:100%;"  value =""></></td>
            <td><input type ='submit' name='aanpasWachtwoord' value='Aanpassen'></b></td></td>
          </tr>
        </table>
      </form>
        <?php
        if(isset($_POST['aanpasNaam'])){
          $aanpasNaam = $_POST['inputNaam'];
          $SQL = "UPDATE gebruiker SET gebruikersnaam = '".$aanpasNaam."' WHERE id = ".$id."";
          $result = mysqli_query($con,$SQL);
          if($result){
              echo"<br><b>De naam is succesvol verwijdert in:<br><b> ".$aanpasNaam."!</b><br><br>  <a href='Account.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
              echo "<meta http-equiv='refresh' content='0'>";
          }else{
            echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
          };
        };
        if(isset($_POST['aanpasEmail'])){
          $aanpasEmail= $_POST['inputEmail'];
          $SQL2 = "UPDATE gebruiker SET email = '".$aanpasEmail."' WHERE id = ".$id."";
          $result2 = mysqli_query($con,$SQL2);
          if($result2){
              echo"<br>Het Email adres is succesvol verandert in:<br><b> ".$aanpasEmail."!</b><br><br>  <a href='Account.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
              echo "<meta http-equiv='refresh' content='0'>";
          }else{
            echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
          };

        };
        if(isset($_POST['aanpasWachtwoord'])){
          $aanpasWachtwoord = crypt($_POST['inputWachtwoord'], '$6$rounds=5000$usesomesillystringforsalt$');

          $SQL3 = "UPDATE gebruiker SET wachtwoord = '".$aanpasWachtwoord."' WHERE id = ".$id."";
          $result3 = mysqli_query($con,$SQL3);
          if($result3){
              echo"<br>De naam is succesvol verwijdert in <br><b>".$aanpasWachtwoord."!</b><br><br>  <a href='Account.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
              echo "<meta http-equiv='refresh' content='0'>";
          }else{
            echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
          };

        };
        ?>
    </div>
  </div>
  <div class="col-md-3">

  </div>
</div>

    </body>
</html>



  </body>
</html>
