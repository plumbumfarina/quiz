<?php


function getFrage($fragen_id){
    include_once('lib/dbConnectorMYSQLI.php');

// Prüfung ob eine angegeben wurde 
  if(isset($fragen_id)) {
// Abfrage aller Informationen einer Frage
    $sqlFrage = "SELECT fragentext FROM fragen WHERE fragen_id = $fragen_id;";
    $result = $conn->query($sqlFragen);
      if ($result->num_rows > 0) {
// Ausgabe des Tabelleninhaltes
        while($row = $result->fetch_assoc()) {
            $fragentext = $row['fragentext'];
        } 
      } else {
        echo "Kein Fragentext gefunden.";
      }
  } else {
    echo "Keine Frage angegeben.";
  }

  return $fragentext;

}

?>