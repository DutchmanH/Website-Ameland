<?php session_start();
require("../private/private-header.php"); ?>
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
    <div style= "margin-bottom:40px;">
    <?php $get_query = $con->query("SELECT * FROM gebruiker ORDER BY status ASC, gebruikersnaam ASC");


echo"  <form method='post' action='gebruikers.php'>
<table border='1'>
  <tr>
  <th><h3>Gebruikersnaam</h3></th>
  <th><h3>Email</h3></th>
  <th><h3>id</h3></th>
  </tr>";

  while($row = mysqli_fetch_array($get_query)){
      if($row['status'] == 0){
        $status = "SUPER Admin";
      }
      if($row['status'] == 1){
        $status = "Admin";
      }
      if($row['status'] == 2){
        $status = "User";
      }
      if($row['status'] == 3){
        $status = "N.A.";
      }
      if($row['status'] == 3){echo"<b><tr style='background-color:darkred ;'>"; }
      elseif($row['status'] == 2){echo"<b><tr style='background-color:DarkGreen;'>";}
      elseif($row['status'] == 1){echo"<b><tr style='background-color:#008cba;'>";}
      elseif($row['status'] == 99){echo"<b><tr style='background-color:OrangeRed ;'>";}else{
        echo"<b><tr style='background-color:OrangeRed ;'>";
      }
      echo "


      <td style='color:white;'><h4><b>".$row['gebruikersnaam']."</h4></td>
      <td style='padding-left:4px; padding-right:4px; color:white;'><h4><b>".$row['email']."</h4></td>
      <td style='color:white;'><h4><b>".$row['id']."</h4></td>
      <td><input type ='submit' name='UpAdmin[".$row['id']."]' value='Admin' style = 'border-radius:10px; background-color:ForestGreen ; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
      <td><input type ='submit' name='UpUser[".$row['id']."]' value='User' style = 'border-radius:10px; background-color: ForestGreen ; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></td>
      <td><input type ='submit' name='Upniet[".$row['id']."]' value='niet geactiveerd'  style = 'border-radius:10px; background-color: ForestGreen ; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;' ></td>
      "; if ($status != "SUPER Admin"){echo"<td><input type ='submit' name='Verwijderen[".$row['id']."]' value='Verwijderen'  style = 'border-radius:10px; background-color: FireBrick ; border: none; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;'></b></td>";}else{echo"<td></td>";}
      echo"<td style='color:white;'><h4><b>".$status."</h4></td>
";
    };
    echo "</tr></form></table>";

    if(isset($_POST['Verwijderen'])){
      $bericht = $_POST['Verwijderen'];
      foreach($bericht as $key => $value) {
       $bericht = $key;
      };
      $result = $db->query("DELETE FROM gebruiker WHERE id = ".$bericht."");
      if($result){
        echo "<meta http-equiv='refresh' content='0'>";
      }else{
        echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
      };
    };
    if(isset($_POST['Upniet'])){
      $bericht = $_POST['Upniet'];
      foreach($bericht as $key => $value) {
       $bericht = $key;
      };

      $result = $db->query("UPDATE gebruiker SET status = 3 WHERE id = ".$bericht."");
      if($result){
        echo "<meta http-equiv='refresh' content='0'>";
      }else{
        echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
      };
    };
    if(isset($_POST['UpUser'])){
      $bericht = $_POST['UpUser'];
      foreach($bericht as $key => $value) {
       $bericht = $key;
      };

      $result = $db->query("UPDATE gebruiker SET status = 2 WHERE id = ".$bericht."");
      if($result){
        echo "<meta http-equiv='refresh' content='0'>";
      }else{
        echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
      };
    };
    if(isset($_POST['UpAdmin'])){
      $bericht = $_POST['UpAdmin'];
      foreach($bericht as $key => $value) {
       $bericht = $key;
      };

      $result = $db->query("UPDATE gebruiker SET status = 1 WHERE id = ".$bericht."");
      if($result){
        echo "<meta http-equiv='refresh' content='0'>";
      }else{
        echo"<b>Er is iets misgegaan tijdens het verwerken! Vraag de beheerder om hulp!  </b>";
      };
    };
?>
</div>

  </div>

    </div>
  </div>
  <div class="col-md-3">

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

    </body>
</html>



  </body>
</html>
