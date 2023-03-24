<?php
// check if user is logged in, if not redirect to login page
session_start();
/* if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} */

include_once('lib/getFragenAnzahl.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Einzelspieler</title>
</head>
<body>
<?php
    include_once('navbar.php')
?>

<div>
    <div class="container mt-3">
        <h1 class="formTitle">Kartendecks</h1>
        <div>
            <button type='button' class='button' onclick="window.location.href = 'deckOeffentlich.php';"> Öffentliche Kartendecks spielen </button>
        </div>
        <br>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Deckname</th>
                        <th>Modulkürzel</th>
                        <th>Modulname</th>
                        <th>Anazahl Fragen</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        include_once('lib/dbConnectorMYSQLI.php');

                        // SQL Abfrage um die eigenen Kartendecks zu ermitteln
                        $sql = "SELECT kartendeck_id, kartendeck_name, kartendeck.modul_id, public, modulkuerzel, modulname FROM kartendeck JOIN modul WHERE (kartendeck.modul_id = modul.modul_id) AND (user_id = $user_id)";
                        $result = $conn->query($sql);

                        function getFragenAnzahl($kartendeck_id){
                            global $conn;
                            $result1 = $conn->query("SELECT * FROM fragen WHERE kartendeck_id = $kartendeck_id");
                            // Anzahl der Zeilen in der Ergebnismenge abrufen
                            $anzahlFragen = $result1->num_rows;

                            return $anzahlFragen;
                        }

                        if ($result->num_rows > 0) {
                            // Ausgabe der SQL Abfrage
                            while($row = $result->fetch_assoc()) {
                                $fragenAnzahl = getFragenAnzahl($row["kartendeck_id"]);
                                echo "<tr>
                                    <td>" . $row["kartendeck_name"]. "</td>
                                    <td>" . $row["modulkuerzel"]. "</td>
                                    <td>" . $row["modulname"]. "</td>
                                    <td>" . $fragenAnzahl. "</td>
                                    <td>
                                        <button type='button' class='buttonSpielen' value='" . $row["kartendeck_id"]. "' onclick='openPageGame(" .  $row['kartendeck_id']. ")'". ($fragenAnzahl == 0 ? " disabled" : "") ."> Spielen </button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            //Ausgabe bei leerer Abfrage
                            echo "<tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
    </div>
</div>
<script>
    function openPageGame(id) {
    window.location.href = "antworten.php?kartendeck_id=" + id;
    }
</script>

</body>
</html>