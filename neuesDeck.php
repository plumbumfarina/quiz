// Maske für Frage plus 4 Antworten, nach jeder Frage klick auf weiter
// -> Fragen und Antworten werden direkt in die DB geschrieben.


// createDeck.php
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "quiz";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create a new deck
$deckName = $_POST["deckName"];
$sql = "INSERT INTO decks (name) VALUES ('$deckName')";
mysqli_query($conn, $sql);
$deckId = mysqli_insert_id($conn);

// Add questions to the deck
$questions = $_POST["question"];
$answers1 = $_POST["answer1"];
$answers2 = $_POST["answer2"];
$answers3 = $_POST["answer3"];
$answers4 = $_POST["answer4"];
for ($i = 0; $i < count($questions); $i++) {
    $question = $questions[$i];
    $answer1 = $answers1[$i];
    $answer2 = $answers2[$i];
    $answer3 = $answers3[$i];
    $answer4 = $answers4[$i];
    // Add question to the database
    $sql = "INSERT INTO fragen (fragendeck_id, question) VALUES ('$deckId', '$question')";
    mysqli_query($conn, $sql);
    $questionId = mysqli_insert_id($conn);
    // Add answers to the database
    $sql = "INSERT INTO antworten (fragen_id, antworttext, richtigkeit) VALUES ('$questionId', '$answer1', 1)";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO antworten (fragen_id, antworttext, richtigkeit) VALUES ('$questionId', '$answer2', 0)";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO antworten (fragen_id, antworttext, richtigkeit) VALUES ('$questionId', '$answer3', 0)";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO antworten (fragen_id, antworttext, richtigkeit) VALUES ('$questionId', '$answer4', 0)";
    mysqli_query($conn, $sql);
}

// Close the database connection
mysqli_close($conn);
?>
