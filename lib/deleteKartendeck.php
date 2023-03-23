<?php
session_start();

include('lib/dbConnectorMYSQLI.php');

$kartendeck_id = $_GET['kartendeck_id'];

// Prüfung ob eine Kartendeck_ID angegeben wurde
if(isset($kartendeck_id)) {
    // Statement zum Löschen aller Fragen des Kartendecks bezüglich Abhängigkeit der Tabelle
    $sqlFragen = "DELETE FROM fragen WHERE kartendeck_id = $kartendeck_id";
    // Ausführung Löschung und Prüfung, ob Löschung der Fragen erfolgreich war
    if ($conn->query($sqlFragen) === TRUE) {
        // Statement tum Löschen des entsprechenden Kartendecks
        $sqlFragenDeck = "DELETE FROM kartendeck WHERE kartendeck_id = $kartendeck_id";
    }
} else {
    echo "Kein Kartendeckname angegeben.";
}

// Ausführung Löschung und Prüfung, ob Löschung des Kartendecks erfolgreich war
if ($conn->query($sqlKartenDeck) === TRUE) {
  // Absprung auf Kartendeckübersicht
  header("Refresh: 0.1; URL=../decks.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>