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

$fragentext = $_GET['fragentext'];
$fragendeck_id = $_GET['fragendeck_id'];
$antwortEins = $_GET['Antwort1'];
$antwortzwei = $_GET['Antwort2'];
$antwortDrei = $_GET['Antwort3'];
$antwortVier = $_GET['Antwort4'];
$richtigkeit = $_GET['richtigkeit'];

// Prüfung ob ein Fragendeckname angegeben wurde
//if(isset($fragendeck_id)) {
//    $sql = "INSERT INTO new_table (fragentext, fragendeck_id, antwortEins, antwortZwei, antwortDrei, antwortVier, richtigkeit) VALUES ('$fragentext', '$fragendeck_id', '$antwortEins', '$antwortZwei', '$antwortDrei', '$antwortVier', '$richtigkeit')";
//} else {
//    echo "Keine richtige Antwort angegeben.";
//}

if ($conn->query($sql) === TRUE) {
  header("Refresh: 10; URL=../addQuestion.php");
  echo "Neues Fragendeck erfolgreich angelegt. In 5 Sekunden geht es zum Login.";
  echo $fragentext ;
  echo $fragendeck_id ;
  echo $antwortEins ;
  echo $antwortzwei ;
  echo $antwortDrei ;
  echo $antwortVier ;
  echo $richtigkeit ;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>