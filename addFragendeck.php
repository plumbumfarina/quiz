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

$sql = "INSERT INTO fragendeck (fragendeck_name, modul_id, user_id) VALUES ('$deckname', (SELECT modul_id FROM modul WHERE modulkuerzel='$modulkuerzel'), $user_id)";

if ($conn->query($sql) === TRUE) {
  echo "New fragendeck created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


?>