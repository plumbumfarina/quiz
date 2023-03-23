<?php
session_start();

include('lib/dbConnector.php');

$fragen_id = $_POST['fragenID'];
$fragentext = $_POST['fragentext'];
$antwortEins = $_POST['Antwort1'];
$antwortZwei = $_POST['Antwort2'];
$antwortDrei = $_POST['Antwort3'];
$antwortVier = $_POST['Antwort4'];
$richtigkeit = $_POST['richtigkeit'];

// Prüfung ob ein Fragendeckname angegeben wurde
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
  //Update der entsprechenden Frage
    $sql = "UPDATE fragen SET fragentext = '$fragentext', antwortEins = '$antwortEins', antwortZwei = '$antwortZwei', antwortDrei = '$antwortDrei', antwortVier = '$antwortVier', richtigkeit = '$richtigkeit' WHERE fragen_id = '$fragen_id'";
} else {
    echo "Keine richtige Antwort angegeben.";
}
// Prüfung ob Update der Frage erfolgreich war
if ($conn->query($sql) === TRUE) {
  // Absprung auf die Übersciht der Fragen mit Übergabe der Kartendeck_ID
  header("Refresh: 0.1; URL=../fragenUebersicht.php?kartendeck_id=$kartendeck_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
