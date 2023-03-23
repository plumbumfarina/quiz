<?php
session_start();

include('lib/dbConnectorMYSQLI.php');

$fragendeck_id = $_POST['kartendeck_id'];
$fragentext = $_POST['fragentext'];
$antwortEins = $_POST['Antwort1'];
$antwortZwei = $_POST['Antwort2'];
$antwortDrei = $_POST['Antwort3'];
$antwortVier = $_POST['Antwort4'];
$richtigkeit = $_POST['richtigkeit'];

// Prüfung ob ein Fragendeckname angegeben wurde
if(isset($fragendeck_id)) {
    $sql = "INSERT INTO fragen (fragentext, kartendeck_id, antwortEins, antwortZwei, antwortDrei, antwortVier, richtigkeit) VALUES ('$fragentext', '$fragendeck_id', '$antwortEins', '$antwortZwei', '$antwortDrei', '$antwortVier', '$richtigkeit')";
} else {
    echo "Keine richtige Antwort angegeben.";
}

if ($conn->query($sql) === TRUE) {
  header("Refresh: 0.1; URL=../fragenUebersicht.php?kartendeck_id=$kartendeck_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>