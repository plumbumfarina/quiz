<?php
session_start();

include_once('lib/dbConnectorMYSQLI');

$user_id = $_SESSION['userid'];

$deckname = $_POST['deckname'];
$modulname = $_POST['modul'];
$public = $_POST['public'];

// Prüfung ob ein Fragendeckname angegeben wurde
if(isset($deckname)) {
    $sql = "INSERT INTO kartendeck (kartendeck_name, modul_id, user_id, public) VALUES ('$deckname', (SELECT modul_id FROM modul WHERE modulname='$modulname'), $user_id, $public)";
} else {
    echo "Kein Kartendeckname angegeben.";
}

if ($conn->query($sql) === TRUE) {
  header("Refresh: 0.1; URL=../decks.php");
  echo "Neues Kartendeck erfolgreich angelegt. In 5 Sekunden geht es zum Login.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>