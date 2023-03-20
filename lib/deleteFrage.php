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

// Prüfung ob ein Fragendeckid angegeben wurde
if(isset($fragen_id)) {
    $sqlFragen = "DELETE FROM new_table WHERE fragen_id = $fragen_id";
} else {
    echo "Kein Frage angegeben.";
}

if ($conn->query($sqlFragenDeck) === TRUE) {
  header("Refresh: 0.1; URL=../fragenUebersicht.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>