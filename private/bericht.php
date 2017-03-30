<?php session_start();
require("../private/private-header.php");?>
<script>
    function Refresh() {
        window.parent.location = window.parent.location.href;
    }
</script>
<?php
function redirect($page) {
    header('Location: ' . $page);
    exit;
};


?>
<!DOCTYPE html>
<html>
  <head>
    <title> Strandgaper Ameland - Bericht</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
<body>
  <div class="contrainer-fluid">

    <div class="row">
      <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%; "></div>
      <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper Ameland</b></div>
    </div>


  </div>
  <div class = "container" >
  <div class="row" style="" >

    <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px;"></div>
  <div class="col-md-10">
    <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
      <h3><b>Totaal aantal berichten</b></h3>
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
      $get_query = $con->query("SELECT * FROM berichten");
      //$show_row = mysqli_fetch_array($get_query);

  echo"  <form method='post' action='bericht.php'>";
      echo "<table border='1'>
    <tr>
    <th>Naam</th>
    <th>Inhoud</th>
    <th>Soort</th>
    </tr>";

    while($row = mysqli_fetch_array($get_query)){
      if($row['Status'] == 0){$status = "Uit";}else{$status="Actief";};
      if($status == "Actief"){
        $actiefID = $row['id'];
        echo "
        <b><tr style='background-color:#008cba;'>
        <td><b>".$row['naam']."</td>
        <td style='padding-left:4px; padding-right:4px;'><b>".$row['inhoud']."</td>
        <td><b>".$row['soort']."</td>

        <td><input type ='submit' name='Voorbeeldbericht[".$row['naam'].";".$row['inhoud']."]' value='Voorbeeld' style = 'border-radius:10px; background-color: #4CAF50; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
        <td><input type ='submit' name='activeerbericht[".$row['id']."]' value='Activeren' style = 'border-radius:10px; background-color: #4CAF50; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
        <td><input type ='submit' name='deactiverenbericht[".$row['id']."]' value='Deactiveren'  style = 'border-radius:10px; background-color: #B22222; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
        <td><input type ='submit' name='verwijderbericht[".$row['id']."]' value='Verwijderen'  style = 'border-radius:10px; background-color: #800000; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></b></td>
        <td style=''><b>ACTIEF</b></td>
        </tr>";
      }else{
        echo "
        <b><tr>
        <td>".$row['naam']."</td>
        <td style='padding-left:4px; padding-right:4px;'>".$row['inhoud']."</td>
        <td>".$row['soort']."</td>

        <td><input type ='submit' name='Voorbeeldbericht[".$row['naam'].";".$row['inhoud']."]' value='Voorbeeld' style = 'border-radius:10px; background-color: #4CAF50; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
        <td><input type ='submit' name='activeerbericht[".$row['id']."]' value='Activeren'  style = 'border-radius:10px; background-color: #4CAF50; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
        <td><input type ='submit' name='deactiverenbericht[".$row['id']."]' value='Deactiveren'style = 'border-radius:10px; background-color: #B22222; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
        <td><input type ='submit' name='verwijderbericht[".$row['id']."]' value='Verwijderen' style = 'border-radius:10px; background-color: #800000; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></b></td></tr>";
      }

echo"</form>";
  };
      echo "</table>";

      if(isset($_POST['verwijderbericht'])){
        $bericht = $_POST['verwijderbericht'];

        foreach($bericht as $key => $value) {
         $bericht = $key;
        };
        $result = $db->query("DELETE FROM berichten WHERE id = ".$bericht."");
        if($result){
          echo "<meta http-equiv='refresh' content='0'>";
          echo"<br><b>Bericht ".$bericht." is succesvol verwijdert!<br><br>  <a href='bericht.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
        }else{
          echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
        };
      };
      if(isset($_POST['activeerbericht'])){
        $result = $db->query("SELECT * FROM berichten WHERE Status = 1");
        $num = $result->num_rows;   //kijken hoeveel resultaten er terug gegeven worden


        if($num == 0 || $num==1){
          $activeer = $_POST['activeerbericht'];

          foreach($activeer as $key => $value) {
           $activeer = $key;
          };
          $result2 = $db->query("UPDATE berichten SET Status = 1 WHERE id = ".$activeer."");;
          if($result2){
            	echo "<meta http-equiv='refresh' content='0'>";
              echo"<br><b>Bericht ".$activeer." is succesvol verwijdert!<br><br>  <a href='bericht.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
              if($num == 1 && $activeer != $actiefID){
              $result3 = $db->query("UPDATE berichten SET Status = 0 WHERE id = ".$actiefID."");;
              if($result3){
                echo "<meta http-equiv='refresh' content='0'>";
              };
            };
          }else{
            echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
          };
        }else{
          $message = "Er kan maar 1 bericht tegelijk actief zijn!";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }

      };
      if(isset($_POST['Voorbeeldbericht'])){
        $voorbeeldbericht = $_POST['Voorbeeldbericht'];

        foreach($voorbeeldbericht as $key => $value) {
         $voorbeeldbericht = $key;
        };
        $bericht = substr($voorbeeldbericht, strpos($voorbeeldbericht, ";")  +1);
        $naam = substr($voorbeeldbericht, 0,strpos($voorbeeldbericht, ";"));
       require("../includes/testvensterzonderdiv.php");
      };
      if(isset($_POST['deactiverenbericht'])){
        $deactiveer = $_POST['deactiverenbericht'];
        foreach($deactiveer as $key => $value) {
         $deactiveer = $key;
        };
        $result = $db->query("UPDATE berichten SET Status = 0 WHERE id = ".$deactiveer."");
        if($result){
            echo "<meta http-equiv='refresh' content='0'>";
            $message = "<br><b>Bericht ".$deactiveer." is succesvol verwijdert!<br><br>  <a href='bericht.php' style='font-size:130%; background-color:#008cba; color:black; border-radius: 10px;padding:3px;'>Klik hier om te vernieuwen</a></b>";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }else{
          echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
        };
      };
?>


    </div>
  </div>
  <div class="col-md-6">
    <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
      <h3><b>Bericht toevoegen</b></h3>
      <form method="post" action="bericht.php">
        <table>
        <tr><td><h4>Naam: </h4></td> <td> <input type="text" name="naam" value="<?php echo isset($_POST['naam']) ? $_POST['naam'] : '' ?>" ></td></tr>
        <tr><td><h4>Bericht: </h4></td><td><textarea name="bericht" rows="4" cols="40 " value="hallo<?php if(isset($_POST['bericht'])){echo $_POST['bericht'];}?>"style="max-width:400px; max-height:200px;"></textarea></td></tr>
        <tr><td><h4>Soort: </h4></td><td >
          <input type="radio" name="soort" value="Belangrijk">Belangrijk
          <input type="radio" name="soort" value="Aanbieding">Aanbieding</td></tr>
      </table></br>
        <input type="hidden" name ="hidden">
        <input type="submit" name="Verzenden" />
        <input type="submit" name ="Voorbeeld" value="Voorbeeld" />
    </form><br /><br />

    <?php require("../includes/dbconnect.php");?>
    <?php
    if(isset($_POST['Voorbeeld']) && $_POST['naam'] != "" && $_POST['bericht'] != "" && isset($_POST['soort'])){
      $naam = $_POST['naam'];
      $bericht = $_POST['bericht'];
      $soort = $_POST['soort'];

        require("../includes/testvensterzonderdiv.php");

      }else{

      };


    if(isset($_POST['Verzenden']) && $_POST['naam']!= "" && $_POST['bericht'] != ""){
      //Ophalen van de variabelen uit het FORM en omzetten naar normale variabelen
      $naam = $_POST['naam'];
      $bericht = $_POST['bericht'];
      $soort = $_POST['soort'];
      if($soort == ""){$soort = "Aanbieding";};
      $result = $db->query("INSERT INTO `berichten` (`id`, `naam`, `inhoud`, `soort`,`status`) VALUES (NULL, '".$naam."', '".$bericht."', '".$soort."',0);");
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
