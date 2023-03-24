<?php
// check if user is logged in, if not redirect to login page
session_start();
/* if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} */



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
<?php
    include_once('navbar.php')
?>

<div>
    <div>
        <h1 class="formTitle">Übersicht der Fragen</h1>
        <br>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Frage</th>
                        <th>Beantwortet</th>
                        <th></th>
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
                        $user_id = $_SESSION['userid'];
                        $fragenListe = array();
                        $antworten = array();
                        $currentIndex = 0;

//SQL Abfrage für alle Fragen-IDs
                        $sql = "SELECT fragen_id FROM fragen WHERE kartendeck_id = $kartendeck_id";
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

//Tabelle erstellen mit Fragen IDs und der Antworten
                        for($i = 0; $i < count($fragenListe); $i++) {
                            $antworten[$i] = '0';
                            echo "<tr>
                                <td>Frage " . ($i + 1) . "</td>
                                <td>";
                                if ($antworten[$i] == '1') {
                                    echo "Antwort 1";
                                } elseif ($antworten[$i] == '2') {
                                    echo "Antwort 2";
                                } elseif ($antworten[$i] == '3') {
                                    echo "Antwort 3";
                                } elseif ($antworten[$i] == '4') {
                                    echo "Antwort 4";
                                } else {
                                    echo "Keine Antwort";
                                }
                                echo "</td>
                            </tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
            <div>
                <button type="button" class="buttonSpielen" onclick="openStart(<?php $fragenListe[$currentIndex] ?>)"> Quiz beginnen! </button>
            </div>
    </div>
</div>
<script>
    function openStart(id) {
    window.location.href = "antworten.php?fragen_id=" + id;
    }
</script>

</body>
</html>