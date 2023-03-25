<?php
// check if user is logged in, if not redirect to login page
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} 

?>

<?php

    if(isset($_GET['weiter'])) {
        $fragenIndex = $_SESSION['fragenListe'];
        array_shift($fragenIndex);
        $_SESSION['fragenListe'] = $fragenIndex;
        if(!empty($fragenIndex)) {
            header("Location: antworten.php?fragen_id=" . $fragenIndex[0]);
        } else {
            header("Location: finaleUebersicht.php");
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <title>Frage</title>
</head>
<body>
<header>
    <?php
        include_once('navbar.php')
    ?>
</header>
<div>
    <div class="container mt-3">
        <h1 class="form__title">Frage</h1>
        <?php
// Datenbank-Verbindung
            $servername = "localhost";
            $username = "root";
            $password = "toor";
            $dbname = "ProjektQuiz";
        
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
// wichtige Variablen 
            $kartendeck_id = $_GET['kartendeck_id'];
            $user_id = $_SESSION['userid'];
            $fragenIndex = $_SESSION['fragenListe'];
            $fragen_id = $fragenIndex[0];
            //$fragen_id = $_GET['fragen_id'];
            $selectedAnswers = array();
            $_SESSION['selecteAnswers'] = $selectedAnswers;

// Funktion um die aktuelle Frage herauszufinden
            function getFrage($conn, $fragen_id){
            // Prüfung ob eine Fragen-ID angegeben wurde 
                if(isset($fragen_id)) {
                    $sqlFrage = "SELECT fragentext FROM fragen WHERE fragen_id = $fragen_id";
                    $resultFrage = $conn->query($sqlFrage);

                    if (!$resultFrage) {
                        printf("Error: %s\n", mysqli_error($conn));
                        exit();
                    }

                    if($resultFrage->num_rows == 1){
                        $rowFrage = $resultFrage->fetch_assoc();
                        $fragentext = $rowFrage['fragentext']; 
                    } else {
                        echo "Fehler: Die Abfrage gibt das falsche Ergebnis zurück!";
                    }
                } else {
                    echo "Keine Frage angegeben.";
                }

                return $fragentext;
            }

// Funktion um die aktuellen Antworten herauszufinden
            function getAntworten($conn, $fragen_id){
            // Prüfung ob eine Fragen-ID angegeben wurde 
                if(isset($fragen_id)) {
                    $sqlAntwort = "SELECT antwortEins, antwortZwei, antwortDrei, antwortVier FROM fragen WHERE fragen_id = $fragen_id";
                    $resultAntwort = $conn->query($sqlAntwort);

                    if (!$resultAntwort) {
                        printf("Error: %s\n", mysqli_error($conn));
                        exit();
                    }

                    if($resultAntwort->num_rows == 1){
                        $rowAntwort = $resultAntwort->fetch_assoc();
                        $antwort1 = $rowAntwort['antwortEins']; 
                        $antwort2 = $rowAntwort['antwortZwei']; 
                        $antwort3 = $rowAntwort['antwortDrei']; 
                        $antwort4 = $rowAntwort['antwortVier']; 
                    } else {
                        echo "Fehler: Die Abfrage gibt das falsche Ergebnis zurück!";
                    }
                } else {
                    echo "Keine Frage angegeben.";
                }

                // Mischen der Antworten
                $antwortenArray = array($antwort1, $antwort2, $antwort3, $antwort4);
                shuffle($antwortenArray);

                return $antwortenArray;
            }

              $currentFrage = getFrage($conn, $_GET['fragen_id']);
              $currentAntworten = getAntworten($conn, $_GET['fragen_id']);

			$conn->close();
                        
        ?>

        <form action="?weiter=1" method="post">
            <p><?php foreach ($_SESSION['fragenListe'] as $fragen_id) {echo $fragen_id . " ";} ?></p>
            <p><?php echo $currentFrage; ?></p>
            <input type="hidden" name="question_id" value="<?php echo $fragen_id; ?>">
        <?php
            echo"  
                <button type='button' name='answer' value='1'>" . $currentAntworten[0] . "</button>
                <button type='button' name='answer' value='2'>" . $currentAntworten[1] . "</button>
                <button type='button' name='answer' value='3'>" . $currentAntworten[2] . "</button>
                <button type='button' name='answer' value='4'>" . $currentAntworten[3] . "</button>
            ";
        ?>  
            <button type="submit" name="next_question">Nächste Frage</button>
        </form>

    </div>
</div>



<?php
	include_once('footer.php')
?>

<script>

document.querySelectorAll('button[name="answer"]').forEach((button) => {
  button.addEventListener('click', () => {
    // Entfernt die class "selected" von allen Buttons
    document.querySelectorAll('button[name="answer"]').forEach((btn) => {
      btn.classList.remove('selected');
    });
    // Fügt dem aktuell ausgewählten Button die class "selected" hinzu
    button.classList.add('selected');
  });
});


//document.querySelector('button[name="next_question"]').addEventListener('click', () => {
//    var selectedAnswer = document.querySelector('button[name="antwort"]:checked').value;
//    <?php echo 'selectedAnswers.push("' . $selectedAnswer . '");'; ?>
//});

</script>
</body>
</html>