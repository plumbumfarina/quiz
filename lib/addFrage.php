<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "quiz";
$user_id = $_SESSION['userid'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$fragendeck_id = $_POST['fragendeck_id'];
$fragentext = $_POST['fragentext'];
$antwortEins = $_POST['Antwort1'];
$antwortZwei = $_POST['Antwort2'];
$antwortDrei = $_POST['Antwort3'];
$antwortVier = $_POST['Antwort4'];
$richtigkeit = $_POST['richtigkeit'];

// Prüfung ob ein Fragendeckname angegeben wurde
if(isset($fragendeck_id)) {
    $sql = "INSERT INTO fragen (fragentext, fragendeck_id, antwortEins, antwortZwei, antwortDrei, antwortVier, richtigkeit) VALUES ('$fragentext', '$fragendeck_id', '$antwortEins', '$antwortZwei', '$antwortDrei', '$antwortVier', '$richtigkeit')";
} else {
    echo "Keine richtige Antwort angegeben.";
}

if ($conn->query($sql) === TRUE) {
  header("Refresh: 0.1; URL=../fragenUebersicht.php?fragendeck_id=$fragendeck_id");
  echo "Neues Fragendeck erfolgreich angelegt. In 5 Sekunden geht es zum Login.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>