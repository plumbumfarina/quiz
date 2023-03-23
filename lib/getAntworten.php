<?php

include_once('lib/dbConnectorMYSQLI.php');

function getAntworten($fragen_id){

// Prüfung ob eine angegeben wurde 
  if(isset($fragen_id)) {
// Abfrage aller Informationen einer Frage
    $sqlFrage = "SELECT antwortEins, antwortZwei, antwortDrei, antwortVier FROM fragen WHERE fragen_id = $fragen_id;";
    $result = $conn->query($sqlFragen);
      if ($result->num_rows > 0) {
// Ausgabe des Tabelleninhaltes
        while($row = $result->fetch_assoc()) {
            $antwortEins = $row['Antwort1'];
            $antwortZwei = $row['Antwort2'];
            $antwortDrei = $row['Antwort3'];
            $antwortVier = $row['Antwort4'];
        } 
      } else {
        echo "Kein Fragentext gefunden.";
      }
  } else {
    echo "Keine Frage angegeben.";
  }

// Mischen der Antworten
  $antwortenArray = array($antwortEins, $antwortZwei, $antwortDrei, $antwortVier);
  shuffle($antwortenArray);

  return $antwortenArray;

}

?>