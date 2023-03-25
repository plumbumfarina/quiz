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
            include_once('navbar.php')
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

//SQL Abfrage für alle Fragen-IDs und Fragentexte

                        $sql = "SELECT fragen_id, fragentext FROM fragen WHERE kartendeck_id = $kartendeck_id AND fragen_id IN (".implode(',', $fragenListeUebersicht).")";
                        $result = mysqli_query($conn, $sql);

                        // Durch die Übergebenen fragen_ids schleifen und diese der gespielten Reihe nach ausgeben
                        foreach ($fragenListeUebersicht as $id) {
                            // Die passende Zeile zur aktuellen ID finden
                            mysqli_data_seek($result, 0);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['fragen_id'] == $id) {
                                // eine neue Zeile mit dem aktuellen Fragentext hinzufügen
                                echo '<tr class="TRDeck"><td>'.$row['fragentext'].'</td>';

                                // antworten in zweite spalte
                                echo '<td>';
                                foreach ($selectedAnswer as $answer) {
                                    echo $answer;
                                  }
                                echo '</td></tr>';
                                break;
                                }
                            }
                        }

                        foreach ($selectedAnswer as $answer) {
                            echo "<tr><td>" . $answer . "</td></tr>";
                          }

                        // zweite spalte
                        $index = 0;
                        mysqli_data_seek($result, 0);
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['fragen_id'] == $fragenListeUebersicht[$index]) {
                                echo '<script>document.querySelector("table").rows['.($index+1).'].cells[1].innerHTML = "'.$selectedAnswer[$index].'";</script>';
                                $index++;
                            }
                        }
                        
/*
//Tabelle erstellen mit Fragen IDs und der Antworten

                        foreach($fragenListe as $frage) {

                            echo "<tr>";
                            echo "<td>" . $frage['fragentext'] . "</td>";
                            echo "<td>" . $frage['fragentext'] . "</td>";
                            echo "</tr>";
                        }
*/
                        #for($i = 0; $i < count($fragenListe); $i++) {
                        #    $antworten[$i] = '0';
                        #    echo "<tr>
                        #        <td>Frage " . ($i + 1) . "</td>
                        #        <td>";
                        #        if ($antworten[$i] == '1') {
                        #            echo "$fragenListe[$i]";
                        #        } elseif ($antworten[$i] == '2') {
                        #            echo "Antwort 2";
                        #        } elseif ($antworten[$i] == '3') {
                        #            echo "Antwort 3";
                        #        } elseif ($antworten[$i] == '4') {
                        #            echo "Antwort 4";
                        #        } else {
                        #            echo "Keine Antwort";
                        #        }
                        #        echo "</td>
                        #    </tr>";
                        #}

                        $conn->close();
                    ?>
                </tbody>
            </table>
            <div>
            <button type="button" class="buttonSpielen" onclick="window.location.href='startGame.php';"> Quiz beenden! </button>
        </div>
    </main>
    <script>
    //    function openStart(id) {
    //    window.location.href = "antworten.php?fragen_id=" + id;
    //    }
    </script>
    <footer>

    </footer>

</body>
</html>