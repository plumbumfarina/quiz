<?php

include_once('lib/dbConnectorMYSQLI.php');

function getFragenListe($kartendeck_id){

// leeres Array deklarieren 
  $fragenIDArray = array();

// Prüfung ob eine angegeben wurde 
  if(isset($kartendeck_id)) {
//Abfrage aller Fragen_IDs des Fragendecks
    $sqlFragen = "SELECT fragen_id FROM fragen WHERE kartendeck_id = $kartendeck_id;";
    $result = $conn->query($sqlFragen);
      if ($result->num_rows > 0) {
// Ausgabe des Tabelleninhaltes
        while($row = $result->fetch_assoc()) {
          $fragenIDArray[] = $row['fragen_id'];
        } 
      } else {
        echo "Keine Fragen gefunden.";
      }
  } else {
    echo "Kein Kartendeck angegeben.";
  }
// Mischen der Fragen_IDs
  shuffle($fragenIDArray);

  return $fragenIDArray;

}

?>