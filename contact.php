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
    require("/includes/functions.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title> >Strandgaper Ameland - Live</title>
  </head>
  <body style="background-color:#d9d9d9; margin-bottom:150px; ">
    <div class="contrainer-fluid">
      <div class="row">
        <div style=""><img src="/img/fotostrand2.jpg" style="width: 100%;"></div>
        <div style="text-align: center; font-size:400%; border-top: solid #222222 30px; margin-bottom:20px;"><b>Strandgaper Ameland - Contact</b></div>
      </div>
    </div>
    <div class = "container" >
      <div class="row" style="" >

        <div style="text-align: center; font-size:400%; border-top: solid #222222 10px; margin-bottom:20px; margin-top:20px;"></div>



          <div class="col-md-6">
            <div  style="margin-bottom:20px;padding:10px; background-color:#a6a6a6; border-radius: 10px; min-height:250px;">
              <h3><b>Contact opnemen</b></h3>
              <form method="post" action="contact.php">
                <table>
                <tr><td><h4>Naam: </h4></td> <td> <input type="text" name="naam" value="<?php echo isset($_POST['naam']) ? $_POST['naam'] : '' ?>" ></td></tr>
                <tr><td><h4>Email: </h4></td> <td> <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" ></td></tr>
                <tr><td><h4>Bericht: </h4></td><td><textarea name="bericht" rows="10" cols="35 " value="hallo<?php if(isset($_POST['bericht'])){echo $_POST['bericht'];}?>"style="max-width:600px; max-height:400px;"></textarea></td></tr>
                </tr></table>
                <h4>Ik wil informatie over </h4>
                  <input type="radio" name="soort" value="Beschikbaarheid">Beschikbaarheid </br>
                  <input type="radio" name="soort" value="het huisje">het huisje zelf<br>
                  <input type="radio" name="soort" value="overig">overig<br>
                </br></br>
                <input type="hidden" name ="hidden"/>
                <input type="submit" name="Verzenden" />

            </form>

          </div>

        </div>
        <div class="col-md-5">
          <?php
          if(isset($_POST['hidden'])){
            $error = 0;
            if(isset($_POST['soort'])){
              $soort = $_POST['soort'];
            }else{
              $error += 1;
              echo"<div style = 'background-color:darkred ; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Je hebt niet aangegeven wat voor soort bericht het is
              </div></b><br>";
            }

            if($_POST['naam'] != ""){
              $naam = $_POST['naam'];
            }else{
              $error += 1;
              echo"<div style = 'background-color:darkred ; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Je hebt geen naam ingevuld!
              </div></b><br>";
            }
            if($_POST['email'] != ""){
              if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error += 1;
                echo"<div style = 'background-color:darkred; color:white; margin:10px; padding:10px; border-radius:5px;'>
                Het email adres is niet correct!</div></b><br>";
              }
            }else{
              $error += 1;
              echo"<div style = 'background-color:darkred ; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Je hebt geen email ingevuld!
              </div></b><br>";
            }
            if($_POST['bericht'] != ""){
              $bericht = $_POST['bericht'];
            }else{
              $error += 1;
              echo"<div style = 'background-color:darkred ; color:white; margin:10px; padding:10px; border-radius:5px;'>
              Je hebt geen bericht ingevuld!
              </div></b><br>";
            }
            if($error == 0){
              echo"<div style = 'background-color:DarkGreen ; color:white; margin:10px; padding:10px; border-radius:5px;'>
              De mail is verstuurd!
              </div></b><br>";
            }
          }


          ?>
        </div>



        </div>

        <?php
        if(isset($_SESSION['status'])){
          if($_SESSION['status'] == "admin"){
            require("/private/private-footer.html");
          }elseif($_SESSION['status'] == "user"){
            require("/user/user-footer.html");
          }elseif($_SESSION['status'] == "SUPER"){
            require("/private/private-footer.html");
          }else{
            require("/includes/public-footer.html");
          };
        }else{
          require("/includes/public-footer.html");
        }
         ?>
    </div>

  </body>
</html>
