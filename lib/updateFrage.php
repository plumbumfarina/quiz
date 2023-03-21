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
  $sqlKartendeckID = "SELECT fragendeck_id FROM fragen WHERE fragen_id = $fragen_id;";
  $result = $conn->query($sqlKartendeckID);
    if ($result->num_rows > 0) {
    // Ausgabe des Tabelleninhaltes
      while($row = $result->fetch_assoc()) {
        $fragendeck_id = $row['fragendeck_id'];
      }
    }  
  //Update der entsprechenden Frage
    $sql = "UPDATE fragen SET fragentext = '$fragentext', antwortEins = '$antwortEins', antwortZwei = '$antwortZwei', antwortDrei = '$antwortDrei', antwortVier = '$antwortVier', richtigkeit = '$richtigkeit' WHERE fragen_id = '$fragen_id'";
} else {
    echo "Keine richtige Antwort angegeben.";
}

if ($conn->query($sql) === TRUE) {
  header("Refresh: 0.1; URL=../fragenUebersicht.php?fragendeck_id=$fragendeck_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
