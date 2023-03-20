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
    $sqlFragen = "DELETE FROM fragen WHERE fragen_id = $fragen_id";
} else {
    echo "Kein Frage angegeben.";
}

if ($conn->query($sqlFragen) === TRUE) {
  header("Refresh: 0.1; URL=../fragenUebersicht.php?fragendeck_id=$fragendeck_id");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>