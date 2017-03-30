<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "login";
  $error1 = "Er kon geen verbinding worden gemaakt met de database";
  $con = mysqli_connect($host,$user,$pass,$db);
  $db = new mysqli($host, $user, $pass, $db) or die($error1);
?>
