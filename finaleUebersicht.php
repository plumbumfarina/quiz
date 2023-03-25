<?php
// check if user is logged in, if not redirect to login page
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <title>Einzelspieler</title>
</head>
<body>
    <header>
        <?php
            include_once('lib/navbar.php')
        ?>
    </header>
	<main>
        <h1 class="formTitle">Übersicht der Fragen</h1>
        <br>
        <p><?php foreach ($_SESSION['selectedAnswers'] as $antwort_id) {echo $antwort_id . " ";} ?></p>

            <table class="TabelleDeck">
                <thead class="THeadDeck">
                    <tr>
                        <th class="THDeck">Frage</th>
                        <th class="THDeck">Beantwortet</th>
                        <th class="THDeck">Richtig</th>
                    </tr>
                </thead>
                <tbody>
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
                        $kartendeck_id = $_SESSION['kartendeck_id'];
                        $fragenListeUebersicht = $_SESSION['fragenListeUebersicht'];
                        $selectedAnswer = $_SESSION['selectedAnswer'];
                        $user_id = $_SESSION['userid'];
                        $fragenListe = array();
                        $antworten = array();
                        $currentIndex = 0;
                        $answerIndex = 0;
                        $totalQuestions = count($fragenListeUebersicht);
                        $correctAnswers = 0;

//SQL Abfrage für alle Fragen-IDs und Fragentexte

                        $sql = "SELECT fragen_id, fragentext, richtigkeit, antwortEins, antwortZwei, antwortDrei, antwortVier FROM fragen WHERE kartendeck_id = $kartendeck_id AND fragen_id IN (".implode(',', $fragenListeUebersicht).")";
                        $result = mysqli_query($conn, $sql);

                        // Durch die Übergebenen fragen_ids schleifen und diese der gespielten Reihe nach ausgeben
                        foreach ($fragenListeUebersicht as $id) {
                            // Die passende Zeile zur aktuellen ID finden
                            mysqli_data_seek($result, 0);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['fragen_id'] == $id) {
                                // eine neue Zeile mit dem aktuellen Fragentext hinzufügen
                                echo '<tr class="TRDeck"><td>'.$row['fragentext'].'</td>';

                                // die passende Antwort zur aktuellen ID finden
                                $antwort = '';
                                switch ($row['richtigkeit']) {
                                    case 1:
                                        $antwort = $row['antwortEins'];
                                        break;
                                    case 2:
                                        $antwort = $row['antwortZwei'];
                                        break;
                                    case 3:
                                        $antwort = $row['antwortDrei'];
                                        break;
                                    case 4:
                                        $antwort = $row['antwortVier'];
                                        break;
                                }
                                // die ausgewählte Antwort anzeigen oder eine Leerzelle, falls keine ausgewählt wurde
                                echo '<td>';
                                if (isset($selectedAnswer[$answerIndex])) {
                                    echo $selectedAnswer[$answerIndex];
                                }
                                echo '</td>';

                                // die korrekte Antwort anzeigen
                                echo '<td>'.$antwort.'</td>';

                                if (isset($selectedAnswer[$answerIndex]) && $selectedAnswer[$answerIndex] == $antwort) {
                                    $correctAnswers++;
                                }

                                $answerIndex++;
                                echo '</tr>';
                                }
                            }
                        }
                        // Berechnung der Prozentual richtig beantworteten Fragen + Ausgabe
                        $percentage = ($correctAnswers / $totalQuestions) * 100;
                        echo '<div style="display:flex;align-items:flex-end;padding-left:20px;" class="ContainerDeck">
                            <h4> Du hast &nbsp; </h4>
                            <h3>'. $correctAnswers .'</h3>
                            <h4>&nbsp; von &nbsp;</h4>
                            <h3>'. $totalQuestions .'</h3>
                            <h4>&nbsp; Fragen richtig beantwortet, das macht &nbsp;</h4>
                            <h3>'. round($percentage, 2) .'%</h3> 
                            </div>
                            <br>
                        ';

                        $conn->close();
                    ?>
                </tbody>
            </table>
            <br>
            <div class="ContainerDeck">
                <button type="button" class="buttonSpielen" onclick="window.location.href='startGame.php';"> Quiz beenden! </button>
            </div>
    </main>
 
    <?php
        include_once('lib/footer.php')
    ?>

</body>
</html>