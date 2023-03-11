<?php
// Start the session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['userid'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}

// Connect to the database
$dbhost = 'localhost';
$dbname = 'quiz';
$dbuser = 'root';
$dbpass = 'toor';

$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Get the available modules
$stmt = $dbh->query("SELECT modulkuerzel FROM modul");

// Fetch the modules as an array
$modules = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $fragendeck_name = $_POST['fragendeck_name'];
    $modul_id = $_POST['modul_id'];
    $fragen = $_POST['fragen'];
    $antworten = $_POST['antworten'];

    // Insert the new fragendeck
    $stmt = $dbh->prepare("INSERT INTO fragendeck (fragendeck_name, modul_id, user_id) VALUES (:fragendeck_name, :modul_id, :user_id)");
    $stmt->bindParam(':fragendeck_name', $fragendeck_name);
    $stmt->bindParam(':modul_id', $modul_id);
    $stmt->bindParam(':user_id', $_SESSION['userid']);
    $stmt->execute();

    // Get the new fragendeck id
    $fragendeck_id = $dbh->lastInsertId();

    // Insert the questions and answers
    foreach($fragen as $key => $frage) {
        $antwort = $antworten[$key];

        $stmt = $dbh->prepare("INSERT INTO fragen (fragentext, fragendeck_id) VALUES (:fragentext, :fragendeck_id)");
        $stmt->bindParam(':fragentext', $frage);
        $stmt->bindParam(':fragendeck_id', $fragendeck_id);
        $stmt->execute();

        $fragen_id = $dbh->lastInsertId();

        $stmt = $dbh->prepare("INSERT INTO antworten (name, antworttext, fragen_id, richtigkeit) VALUES ('', :antworttext, :fragen_id, 1)");
        $stmt->bindParam(':antworttext', $antwort);
        $stmt->bindParam(':fragen_id', $fragen_id);
        $stmt->execute();
    }

    // Redirect the user to the dashboard
    header("Location: decks.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create a new fragendeck</title>
</head>
<body>
    <h1>Create a new fragendeck</h1>

    <form method="post">
        <label for="fragendeck_name">Fragendeck name:</label>
        <input type="text" name="fragendeck_name" required><br><br>

        <label for="modul_id">Modul:</label>
        <select name="modul_id">
            <?php foreach($modules as $module): ?>
                <option value="<?php echo $module; ?>"><?php echo $module; ?></option>
            <?php endforeach; ?>
        </select><br><br>
    
    <h2>Questions and answers:</h2>

    <div id="questions">
        <div class="question">
            <label for="frage">Question:</label>
            <input type="text" name="fragen[]" required><br><br>

            <label for="antwort">Answer:</label>
            <input type="text" name="antworten[]" required><br><br>
        </div>
    </div>

    <button type="button" onclick="addQuestion()">Add another question</button><br><br>

    <button type="submit">Create fragendeck</button>
</form>

<script>
    function addQuestion() {
        var question = document.createElement("div");
        question.setAttribute("class", "question");

        var label = document.createElement("label");
        label.setAttribute("for", "frage");
        label.innerText = "Question:";
        question.appendChild(label);

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "fragen[]");
        input.setAttribute("required", "");
        question.appendChild(input);

        question.appendChild(document.createElement("br"));
        question.appendChild(document.createElement("br"));

        var label = document.createElement("label");
        label.setAttribute("for", "antwort");
        label.innerText = "Answer:";
        question.appendChild(label);

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "antworten[]");
        input.setAttribute("required", "");
        question.appendChild(input);

        question.appendChild(document.createElement("br"));
        question.appendChild(document.createElement("br"));

        document.getElementById("questions").appendChild(question);
    }
</script>