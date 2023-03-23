<?php
session_start();

include('lib/dbConnector.php');

$fragen_id = $_GET['fragen_id'];

// Prüfung ob ein Fragenid angegeben wurde
if(isset($fragen_id)) {
    //Prüfung der Kartendeck_ID für Absprung auf Fragenübersicht
    $sqlKartendeckID = "SELECT fragendeck_id FROM fragen WHERE fragen_id = $fragen_id;";
    $result = $conn->query($sqlKartendeckID);
      if ($result->num_rows > 0) {
      // Ausgabe des Tabelleninhaltes
        while($row = $result->fetch_assoc()) {
          $fragendeck_id = $row['fragendeck_id'];
        }
      }  
    //Löschen der entsprechenden Frage
    $sqlFragen = "DELETE FROM fragen WHERE fragen_id = $fragen_id";
} else {
    echo "Kein Frage gefunden.";
}

if ($conn->query($sqlFragen) === TRUE) {
  header("Refresh: 0.1; URL=../fragenUebersicht.php?fragendeck_id=$fragendeck_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>