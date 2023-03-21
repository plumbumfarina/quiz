<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "quiz";
$user_id = $_SESSION['userid'];

$fragen_id = $_GET['fragen_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prüfung ob ein Fragenid angegeben wurde
if(isset($fragen_id)) {
    //Prüfung der Kartendeck_ID für Absprung auf Fragenübersicht
    $sqlKartendeckID = "SELECT fragendeck_id FROM fragen WHERE fragen_id = $fragen_id;";
    $fragendeck_id = $conn->query($sqlKartendeckID);
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