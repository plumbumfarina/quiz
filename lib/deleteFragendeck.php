<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "quiz";
$user_id = $_SESSION['userid'];

$fragendeck_id = $_GET['fragendeck_id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prüfung ob ein Fragendeckname angegeben wurde
if(isset($fragendeck_id)) {
    $sql = "DELETE FROM fragendeck WHERE fragendeck_id = $fragendeck_id";
} else {
    echo "Kein Fragendeckname angegeben.";
}

if ($conn->query($sql) === TRUE) {
  header("Refresh: 0,1; URL=../decks.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>