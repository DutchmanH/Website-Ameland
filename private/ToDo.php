<?php session_start(); ?>
<?php require("../private/private-header.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - To DO List</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="contrainer-fluid">

    <div class="row">
      <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%; "></div>
      <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>To Do list</b></div>
    </div>
</div>

<div class = "container" >
  <div class="row" style="" >
    <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px;"></div>
    <div class="col-md-10">
      <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <h3><b>To Do list</b></h3>


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

                <?php
                require("../includes/dbconnect.php");
                $get_query = $con->query("SELECT * FROM todo ORDER BY status ASC,prio ASC");
                //$show_row = mysqli_fetch_array($get_query);
            echo"
            <form method='post' action='ToDo.php'>
            <table border='1'>
              <tr>
              <th>bericht</th>
              <th>prio</th>
              </tr>";

              while($row = mysqli_fetch_array($get_query)){
                if($row['status'] == 0){
                  $status = "klaar";
                }elseif($row['status'] == 1){
                  $status="bezig";
                }elseif($row['status'] == 2){
                  $status="nietbezig";
                };
                if($row['prio'] == 0){
                  $prio = "Hoog";
                }elseif($row['prio'] == 1){
                  $prio="Gemiddeld";
                }elseif($row['prio'] == 2){
                  $prio="Laag";
                };
                if($status == "bezig"){
                  $actiefID = $row['id'];
                  echo "
                  <b><tr style='background-color:#008cba;'>
                  <td style='padding-left:4px; padding-right:4px;'><b>".$row['inhoud']."</td>
                  <td><b>".$prio."</td>
                  <td><input type ='submit' name='klaar[".$row['id']."]' value='Klaar'                    style = 'border-radius:10px; background-color: #4CAF50; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
                  <td><input type ='submit' name='werk[".$row['id']."]' value='Word aan gewerkt'          style = 'border-radius:10px; background-color: #FFD700; border: none; color: black; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
                  <td><input type ='submit' name='nietmeebezig[".$row['id']."]' value='Niet mee bezig'    style = 'border-radius:10px; background-color: #B22222; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
                  <td><input type ='submit' name='verwijderbericht[".$row['id']."]' value='Verwijderen'   style = 'border-radius:10px; background-color: #800000; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></b></td>
                  <td style=''><b>Word aan gewerkt</b></td>
                  </tr>";
                }
                elseif($status == "nietbezig"){
                  $actiefID = $row['id'];
                  echo "
                  <b><tr>
                  <td style='padding-left:4px; padding-right:4px;'><b>".$row['inhoud']."</td>
                  <td><b>".$prio."</td>
                  <td><input type ='submit' name='Klaar[".$row['id']."]' value='Klaar'                    style = 'border-radius:10px; background-color: #4CAF50; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
                  <td><input type ='submit' name='werk[".$row['id']."]' value='Word aan gewerkt'          style = 'border-radius:10px; background-color: #FFD700; border: none; color: black; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
                  <td><input type ='submit' name='nietmeebezig[".$row['id']."]' value='Niet mee bezig'    style = 'border-radius:10px; background-color: #B22222; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
                  <td><input type ='submit' name='verwijderbericht[".$row['id']."]' value='Verwijderen'   style = 'border-radius:10px; background-color: #800000; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></b></td>

                  </tr>";
                }
                elseif($status == "klaar"){
                  echo "
                  <b><tr style='background-color:#008000;'>
                  <td style='padding-left:4px; padding-right:4px;'><b>".$row['inhoud']."</td>
                  <td><b>".$prio."</td>
                  <td><input type ='submit' name='Klaar[".$row['id']."]' value='Klaar'                      style = 'border-radius:10px; background-color: #4CAF50; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
                  <td><input type ='submit' name='werk[".$row['id']."]' value='Word aan gewerkt'            style = 'border-radius:10px; background-color: #FFD700; border: none; color: black; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
                  <td><input type ='submit' name='nietmeebezig[".$row['id']."]' value='Niet mee bezig'      style = 'border-radius:10px; background-color: #B22222; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
                  <td><input type ='submit' name='verwijderbericht[".$row['id']."]' value='Verwijderen'     style = 'border-radius:10px; background-color: #800000; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></b></td>
                  <td style=''><b>Klaar</b></td>
                  </tr>";
                };

          echo"</form>";
            };
                echo "</table>";
                if(isset($_POST['verwijderbericht'])){
                  $bericht = $_POST['verwijderbericht'];

                  foreach($bericht as $key => $value) {
                   $bericht = $key;
                  };
                  $result = $db->query("DELETE FROM todo WHERE id = ".$bericht."");
                  if($result){
                    echo "<meta http-equiv='refresh' content='0'>";
                    echo"<br><b>Bericht ".$bericht." is succesvol verwijdert!<br><br>  <a href='bericht.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
                  }else{
                    echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
                  };
                };
                if(isset($_POST['Klaar'])){
                  $activeer = $_POST['Klaar'];
                  foreach($activeer as $key => $value) {
                    $activeer = $key;
                  };
                  $result = $db->query("UPDATE todo SET Status = 0 WHERE id = ".$activeer."");
                  if($result){
                      echo "<meta http-equiv='refresh' content='0'>";
                      echo"<br><b>Bericht ".$activeer." is succesvol verwijdert!<br><br>  <a href='bericht.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
                  }else{
                    echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
                  };
                };
                if(isset($_POST['werk'])){
                  $activeer = $_POST['werk'];
                  foreach($activeer as $key => $value) {
                    $activeer = $key;
                  };
                  $result = $db->query("UPDATE todo SET Status = 1 WHERE id = ".$activeer."");
                  if($result){
                      echo "<meta http-equiv='refresh' content='0'>";
                      echo"<br><b>Bericht ".$activeer." is succesvol verwijdert!<br><br>  <a href='bericht.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
                  }else{
                    echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
                  };
                };
                if(isset($_POST['nietmeebezig'])){
                  $activeer = $_POST['nietmeebezig'];
                  foreach($activeer as $key => $value) {
                    $activeer = $key;
                  };
                  $result = $db->query("UPDATE todo SET Status = 2 WHERE id = ".$activeer."");
                  if($result){
                      echo "<meta http-equiv='refresh' content='0'>";
                      echo"<br><b>Bericht ".$activeer." is succesvol verwijdert!<br><br>  <a href='bericht.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
                  }else{
                    echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
                  };
                };
          ?>


      </div>
    </div>
    <div class="col-md-6">
      <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
        <h3><b>Taak toevoegen</b></h3>
        <form method="post" action="ToDo.php">
          <table>
          <tr><td><h4>Taak: </h4></td> <td> <input type="text" name="taak" value="<?php echo isset($_POST['taak']) ? $_POST['taak'] : '' ?>" ></td></tr>
          <tr><td><h4>Prioriteit: </h4></td><td >
            <input type="radio" name="prio" value="0">Hoog
            <input type="radio" name="prio" value="1">Gemiddeld
            <input type="radio" name="prio" value="2">Laag</td></tr>
        </table></br>
          <input type="hidden" name ="hidden">
          <input type="submit" name="Verzenden" />
      </form><br /><br />

      <?php require("../includes/dbconnect.php");?>
      <?php
      if(isset($_POST['Verzenden']) && $_POST['taak']!= ""){
        //Ophalen van de variabelen uit het FORM en omzetten naar normale variabelen
        $taak = $_POST['taak'];
        $prio = $_POST['prio'];
        if($prio == "0"){
          $prio = 0;
        }elseif($prio == "1"){
          $prio = 1;
        }elseif($prio == "2"){
          $prio = 2;
        }else{
          $prio = 2;
        };

        $SQL = "INSERT INTO `todo` (`id`, `inhoud`, `prio`, `status`) VALUES (NULL, '".$taak."', '".$prio."', '2');";
        $result = mysqli_query($con,$SQL);
        if($result){
          echo "<meta http-equiv='refresh' content='0'>";
        }else{
          echo"niet gelukt";
        };

      }else{
        echo"Niet alles is ingevuld, probeer het opnieuw!";
      };
        //Query die checkt of gebruikersnaam wachtwoord klopt
      ?>
    </div>
  </div>
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
