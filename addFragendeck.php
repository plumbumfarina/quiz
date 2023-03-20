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

$deckname = $_POST['deckname'];
$modulkuerzel = $_POST['modul'];

// Prüfung ob ein Fragendeckname angegeben wurde
if(isset($deckname)) {
    $sql = "INSERT INTO fragendeck (fragendeck_name, modul_id, user_id) VALUES ('$deckname', (SELECT modul_id FROM modul WHERE modulname='$modulname'), $user_id)";
} else {
    echo "Kein Fragendeckname angegeben.";
}

if ($conn->query($sql) === TRUE) {
  header("Refresh: 5; URL=../decks.php");
  echo "Neues Fragendeck erfolgreich angelegt. In 5 Sekunden geht es zum Login.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>