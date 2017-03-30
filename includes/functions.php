<?php
$TotalResults = 8; //check de laatste 2 uur (bij waarde 24) default = 8640 = 7 dagen
//Ameland

$stringA = file_get_contents("https://api.thingspeak.com/channels/176349/feeds.json?results=".$TotalResults."?");
$jsonOutputAmeland = json_decode($stringA, true);

$stringA2 = file_get_contents("https://api.thingspeak.com/channels/228197/feeds.json?results=".$TotalResults."?");
$jsonOutputAmeland2 = json_decode($stringA2, true);

//$stringA3 = file_get_contents("https://api.thingspeak.com/channels/176349/fields/1.json?results=1?");
//$jsonOutputAmeland3 = json_decode($stringA3, true);

function GETThingspeak($field,$Jsonwaardes,$eenheid,$totalresults){
  $Field = $field;
  $localJsonArray = $Jsonwaardes;
  $Eenheid = $eenheid;
  $TotalResults = $totalresults;

  $ValueError = 0; //aantal fouten laatste
  $TempJsonvalue = ""; //Jsonuitkomst
  $TempTime = "";


//--------------------------------------------------------------------------------------------
//--[Functie om de meest recente waarde op te halen] --Opgelet de totalresults/2 moet omdat er nu 2 sensoren op 1 kanaal zitten en er dus altijd 2 null waardes uit komen (komen er meer sensoren op 1 kanaal dan moet het bv / 4 ipv /2)
//--------------------------------------------------------------------------------------------
  if($localJsonArray != NULL){                    // voer dit alleen uit als er een Json waarde in de variabele staat
    foreach ($localJsonArray['feeds'] as $feeds)  // loop door alle (in dit geval 2) waardes van de array heen
    {

    if($feeds[$field] == "" || $feeds[$field] == NULL){$ValueError += 1;}            // als de waarde leeg is dan moet er niks gebeuren
    else{
      $TempTime = $feeds['created_at'];
      $TempJsonvalue = $feeds[$field];
        };      // Als er wel een nieuwere waarde is sla deze dan op
    };
    $ValueError = $ValueError - ($TotalResults/2);
  };
//-------------------------------------------------
//--[Functie om te kijken of hij online is of niet]
//-------------------------------------------------

$Front = "";
$Value = "";
$End = "";

if($ValueError == ($TotalResults/2) ){ //Offline als alle waardes null zijn want dan zijn ze corrupt
  $Front = "offline";
  $End = "Niet aangesloten";
}elseif($TempJsonvalue == ""){
  $Front = "offline";
  $End = "no values";
}else{
  //--------------------------------------
  //--[Functie om de tekst uit te printen]
  //--------------------------------------
  $Value = $TempJsonvalue; // als hij niet ofline is dan krijgt hij de gemeten waarde
  if($Eenheid == "L")
  {
    $Front = "Luchtvochtigheid: ";
    $End = "%\n";
  }
  elseif($Eenheid == "T")
  {
    $Front = "Temperatuur: ";
    $End = "&deg\n";
  }
  elseif($Eenheid == "WR")
  {
    $Front = "Windrichting: ";
    $End = "";
  }
  elseif($Eenheid == "WS")
  {
    $Front = "Windsnelheid: ";
    $End = " m/s ";
  };
$TempEnd = $End;
};
// toewijzen waarden aan juiste variabele
if($TempTime){
  $LastTime = explode("T",$TempTime);
  $TempLastTime = explode("-",$LastTime[0]);
  $lastmonth = $TempLastTime[1];
  $lastday = $TempLastTime[2];
  $TempLastTime =explode(":",substr($LastTime[1], 0, -1));
  $lastmin = $TempLastTime[1];
  $lasthour = $TempLastTime[0] + 2;
  $currentmin   = date("i");
  $currenthour  = date("G");
  $currentday   = date("d");
  $currentmonth = date("m");

  // uitrekenen hoeveel verschil er tussen huidige tijd en laste update zit
  $offmonth = $currentmonth - $lastmonth;
  $offday = $currentday - $lastday;
  $offhour = $currenthour - $lasthour;
  $offmin = $currentmin - $lastmin;

  //correctie op de timer als lastday groter is dan current day (dus een negatief getal dus je moet hem omzetten)
  if($offmin <0){$offmin = 60 + $offmin;};
  if($offhour<0){$offhour = 24 + $offhour;};

  //Na 2 uur is de sensor Offline en zijn de waardes niet meer precies dus gaat de status naar not recent
  if($offhour >= 2 || $End =! "no values" || $offmonth >= 1 || $offday >= 1 ){
    $Front = "offline";
    $End = "not recent";
  };
};

echo "<h4 style='margin-bottom:10px;padding:10px; background-color:#e6e6e6; border-radius: 10px;'>";
echo "";
$TotalMin = 0;
if($Front == "offline"){
  $TotalMin = 20 * ($ValueError);
  echo" <div class='info'><b>[Offline]: </b><br>";
  if($End =="Niet aangesloten"){echo "De Sensor is niet meer aangesloten! (maximale wachttijd van ".$TotalMin." minuten is verstreken)";};
  if($End =="not recent"){
    if($offmonth >= 1){echo " ".$offmonth." maand(en)";};
    if($offday >= 1 || $offmonth >= 1){echo " ".$offday." dag(en)";};
    echo " ".$offhour." uur ".$offmin." minuten.";
    echo "      <span class='meerinfo'><b>Gegevens</b>";
    echo "<br>Huidige tijd: ".$currentmonth."-".$currentday." ".$currenthour.":".$currentmin."";
    echo "<br>Laatste update: ".$lastmonth."-".$lastday." ".$lasthour.":".$lastmin."<br></span></div>";
  };
  if($End =="no values"){echo "Nieuwe Sensor! (geen waardes)";};
}else{
  echo "   <div class='info'><b>".$Front.$Value.$TempEnd."</b> ";

      if(isset($_SESSION['status'])){$status = $_SESSION['status'];}else{$status = "";};
      if($status == "admin" || $status == "SUPER")
      {

        echo "      <span class='meerinfo'><b>Gegevens</b>";
        echo "<br>Huidige tijd: ".$currentmonth."-".$currentday." ".$currenthour.":".$currentmin."";
        echo "<br>Laatste update: ".$lastmonth."-".$lastday." ".$lasthour.":".$lastmin."<br>".$offhour." uur ".$offmin." minuten geleden  </span></div>";
      }else{

      };



};
echo "  ";
echo "</h4>";


};
