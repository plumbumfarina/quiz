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

// Prüfung ob eine Kartendeck_ID angegeben wurde
if(isset($fragendeck_id)) {
    // Löschen aller Fragen des Kartendecks bezüglich Abhängigkeit der Tabelle
    $sqlFragen = "DELETE FROM fragen WHERE fragendeck_id = $fragendeck_id";
    // Prüfung ob Löschung der Fragen erfolgreich war
    if ($conn->query($sqlFragen) === TRUE) {
        // Löschen des entsprechenden Kartendecks
        $sqlFragenDeck = "DELETE FROM fragendeck WHERE fragendeck_id = $fragendeck_id";
    }
} else {
    echo "Kein Fragendeckname angegeben.";
}

// Prüfung ob Löschung des Kartendecks erfolgreich war
if ($conn->query($sqlFragenDeck) === TRUE) {
  // Absprung auf Kartendeckübersicht
  header("Refresh: 0.1; URL=../decks.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>