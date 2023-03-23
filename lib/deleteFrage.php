<?php
session_start();

include_once('lib/dbConnectorMYSQLI.php');

$fragen_id = $_GET['fragen_id'];

// Prüfung ob ein Fragenid angegeben wurde
if(isset($fragen_id)) {
    //Prüfung der Kartendeck_ID für Absprung auf Fragenübersicht
    $sqlKartendeckID = "SELECT kartendeck_id FROM fragen WHERE fragen_id = $fragen_id;";
    $result = $conn->query($sqlKartendeckID);
      if ($result->num_rows > 0) {
      // Ausgabe des Tabelleninhaltes
        while($row = $result->fetch_assoc()) {
          $kartendeck_id = $row['kartendeck_id'];
        }
      }  
    //Löschen der entsprechenden Frage
    $sqlFragen = "DELETE FROM fragen WHERE fragen_id = $fragen_id";
} else {
    echo "Kein Frage gefunden.";
}

if ($conn->query($sqlFragen) === TRUE) {
  header("Refresh: 0.1; URL=../fragenUebersicht.php?kartendeck_id=$kartendeck_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>