<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "quiz";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Store fragendeck name
$deck_name = $_POST['deck_name'];
$sql = "INSERT INTO fragendecks (name) VALUES ('$deck_name')";
if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    // Get fragendeck ID
    $deck_id = $conn->insert_id;

    // Store questions and answers
    $questions = $_POST['questions'];
    $answers = $_POST['answers'];
    $num_questions = count($questions);

    for ($i = 0; $i < $num_questions; $i++) {
        $question = $questions[$i];
        $answer1 = $answers[$i*4];
        $answer2 = $answers[$i*4 + 1];
        $answer3 = $answers[$i*4 + 2];
        $answer4 = $answers[$i*4 + 3];

        $sql = "INSERT INTO fragen (question, answer1, answer2, answer3, answer4, fragendeck_id) VALUES ('$question', '$answer1', '$answer2', '$answer3', '$answer4', $deck_id)";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();

    // Redirect to success page
    header("Location: success.php");
    exit();
}
?>
