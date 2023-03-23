<?php
session_start();

include('lib/dbConnector.php');

$fragendeck_id = $_GET['fragendeck_id'];

// Prüfung ob eine Kartendeck_ID angegeben wurde
if(isset($fragendeck_id)) {
    // Statement zum Löschen aller Fragen des Kartendecks bezüglich Abhängigkeit der Tabelle
    $sqlFragen = "DELETE FROM fragen WHERE fragendeck_id = $fragendeck_id";
    // Ausführung Löschung und Prüfung, ob Löschung der Fragen erfolgreich war
    if ($conn->query($sqlFragen) === TRUE) {
        // Statement tum Löschen des entsprechenden Kartendecks
        $sqlFragenDeck = "DELETE FROM fragendeck WHERE fragendeck_id = $fragendeck_id";
    }
} else {
    echo "Kein Fragendeckname angegeben.";
}

// Ausführung Löschung und Prüfung, ob Löschung des Kartendecks erfolgreich war
if ($conn->query($sqlFragenDeck) === TRUE) {
  // Absprung auf Kartendeckübersicht
  header("Refresh: 0.1; URL=../decks.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>