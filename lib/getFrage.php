<?php

// AKTUELL UNBENUTZT
/*
function getFrage($fragen_id){
    include_once('lib/dbConnectorMYSQLI.php');
// Prüfung ob eine angegeben wurde 
  if(isset($fragen_id)) {
// Abfrage aller Informationen einer Frage
    $sqlFrage = "SELECT fragentext FROM fragen WHERE fragen_id = $fragen_id";
    $resultFrage = $conn->query($sqlFragen);
    $num_rows = $result->num_rows;
    echo $num_rows;
      if ($resultFrage->num_rows > 0) {
// Ausgabe des Tabelleninhaltes
        while($rowFrage = $resultFrage->fetch_assoc()) {
            $fragentext = $rowFrage['fragentext'];
            echo "Test";
        } 
      } else {
        echo "Kein Fragentext gefunden.";
      }
  } else {
    echo "Keine Frage angegeben.";
  }

  return $fragentext;
}
*/
?>