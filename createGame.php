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
</head>
<body>
    <header>
        <?php
            include_once('lib/navbar.php')
        ?>
    </header>
	<main>
        <h1>Freies Spiel eröffnen</h1>
        <div class="ContainerDeck" style="padding:15px;">
            <label for="modul" class="labelDeck">Wähle ein Modul aus:</label>
            <select id="modul" name="modul" class="selectDeck">
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "toor";
                        $dbname = "ProjektQuiz";
                        $user_id = $_SESSION['userid'];

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql1 = "SELECT modulname FROM modul" ;
                        $result1 = $conn->query($sql1);
                            
                        if ($result1->num_rows > 0) {
                        // output data of each row
                            while($row1 = $result1->fetch_assoc()) {
                                echo "<option>" . $row1["modulname"]. "</option>";
                            }
                        } else {
                            echo "<option> keine Module </option>";
                        }

                    ?>
            </select>
            <button class="buttonYellow"> Kartendecks filtern </button>
        </div>
        <br>
        <table class="TabelleDeck">
            <thead class="THeadDeck">
                    <tr>
                        <th class="THDeck">Deckname</th>
                        <th class="THDeck">Modulkürzel</th>
                        <th class="THDeck">Modulname</th>
                        <th class="THDeck">Anazhl Fragen</th>
                        <th class="THDeck"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once('lib/dbConnectorMYSQLI.php');
                        
                        // SQL Abfrage um die öffentlichen Kartendecks zu ermitteln
                        $sql = "SELECT kartendeck_id, kartendeck_name, kartendeck.modul_id, public, modulkuerzel, modulname FROM kartendeck JOIN modul WHERE (kartendeck.modul_id = modul.modul_id) AND (public = TRUE)";
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
                                echo "<tr class='TRDeck'>
                                    <td>" . $row["kartendeck_name"]. "</td>
                                    <td>" . $row["modulkuerzel"]. "</td>
                                    <td>" . $row["modulname"]. "</td>
                                    <td>" . $fragenAnzahl. "</td>
                                    <td>
                                        <button type='button' class='buttonBlue' value='" . $row["kartendeck_id"]. "' onclick='openPageGame(" .  $row['kartendeck_id']. ")'". ($fragenAnzahl == 0 ? " disabled" : "") ."> Spielen </button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            //Ausgabe bei leerer Abfrage
                            echo "<tr class='TRDeck'>
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
    </main>
    <?php
        include_once('lib/footer.php')
    ?>
</body>
</html>