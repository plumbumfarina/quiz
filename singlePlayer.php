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
        
            <table class="TabelleDeck">
                <thead  class="THeadDeck">
                    <tr>
                        <th class="THDeck">Frage</th>
                        <th class="THDeck">Beantwortet</th>
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
                        $kartendeck_id = $_GET['kartendeck_id'];
                        $_SESSION['kartendeck_id'] = $kartendeck_id;
                        $user_id = $_SESSION['userid'];
                        $fragenListe = array();
                        $antworten = array();
                        $currentIndex = 0;

//SQL Abfrage für alle Fragen-IDs
                        $sql = "SELECT fragen_id, fragentext FROM fragen WHERE kartendeck_id = $kartendeck_id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $kartendeck_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $fragenListe[] = $row['fragen_id'];
                            }
                        } else {
                            echo "Keine Fragen gefunden!";
                        }    

			            shuffle($fragenListe);
                        $_SESSION['fragenListe'] = $fragenListe;
                        $_SESSION['fragenListeUebersicht'] = $fragenListe;

                        // Array global anlegen um die Antworten zu speichern
                        $selectedAnswer = array();
                        $_SESSION['selectedAnswer'] = $selectedAnswer;

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

//Tabelle erstellen mit Fragen IDs und der Antworten
                        for($i = 0; $i < count($fragenListe); $i++) {
                            $antworten[$i] = '0';
                            echo "<tr class='TRDeck'>
                                <td>Frage " . ($i + 1) . "</td>
                                <td>" . getFrage($conn, $fragenListe[$i])."</td>
                            </tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        <br>
        <div class="ContainerDeck">
            <button type="button" class="buttonSpielen" onclick="openStart('<?php echo $fragenListe[0]; ?>')"> Quiz beginnen! </button>
        </div>
    </main>
    <script>
        function openStart(id) {
        window.location.href = "answer.php?fragen_id=" + id;
        }
    </script>
    <?php
        include_once('lib/footer.php')
    ?>
</body>
</html>