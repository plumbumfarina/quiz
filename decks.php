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
    <title>Decks</title>
</head>
<body>
<header>
    <?php
        include_once('lib/navbar.php')
    ?>
</header>
<main>
    <div>
        <h1 class="form__title">Kartendecks</h1>
            <table class="TabelleDeck">
                <thead class="THeadDeck">
                    <tr>
                        <th class="THDeck">Deckname</th>
                        <th class="THDeck">Modulkürzel</th>
                        <th class="THDeck">Modulname</th>
                        <th class="THDeck">Anazhl Fragen</th>
                        <th class="THDeck">öffentlich</th>
                        <th class="THDeck"></th>
                        <th class="THDeck"></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            include_once('lib/dbConnectorMYSQLI.php');

                            $user_id = $_SESSION['userid'];
                            $sql = "SELECT kartendeck_id, kartendeck_name, kartendeck.modul_id, public, modulkuerzel, modulname FROM kartendeck JOIN modul WHERE (kartendeck.modul_id = modul.modul_id) AND (user_id = $user_id) ORDER BY modulkuerzel ASC";
                            $result = $conn->query($sql);

                            function getFragenAnzahl($kartendeck_id){
                                global $conn;
                                $result1 = $conn->query("SELECT * FROM fragen WHERE kartendeck_id = $kartendeck_id");
                                // Anzahl der Zeilen in der Ergebnismenge abrufen
                                $anzahlFragen = $result1->num_rows;

                                return $anzahlFragen;
                            }
                            

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr class='TRDeck'>
                                        <td>" . $row["kartendeck_name"]. "</td>
                                        <td>" . $row["modulkuerzel"]. "</td>
                                        <td>" . $row["modulname"]. "</td>
                                        <td>" . getFragenAnzahl($row["kartendeck_id"]) . "</td>
                                        <td>" . ($row["public"] ? "Ja" : "Nein") . "</td>
                                        <td>
                                            <button type='button' class='buttonYellow' value='" . $row["kartendeck_id"]. "' onclick='openBearbeiteKartendeck(" .  $row['kartendeck_id']. ")'> Bearbeiten </button>
                                        </td>
                                        <td>
                                            <button type='button' class='buttonRed' value='" . $row["kartendeck_id"]. "' onclick='openLoescheKartendeck(" .  $row['kartendeck_id']. ")'> Löschen </button>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr class='TRDeck'>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>";
                            }
                            
                        ?>
                </tbody>
            </table>
    </div>
    <div>
        <h1 class="form__title">Kartendeck hinzufügen</h1>
        <div class="ContainerDeck">
            <form action="lib/addKartendeck.php" method="post" class="formDeck">
                <label for="deckname" class="labelDeck">Kartendeckname:</label>
                <input type="text" name="deckname" class="inputDeck" required>

                <label class="labelDeck" for="public">Willst du das Kartendeck für Alle spielbar machen?</label>
                <input type="radio" name="public" value="TRUE" required> Ja </input>
                <input type="radio" name="public" value="FALSE"> Nein </input>

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
                <button style="width:50%;" type="submit" class="buttonGreen"> Hinzufügen</button>    
            </form>
        </div>
    </div>
</main>

<script>
function openBearbeiteKartendeck(id) {
  window.location.href = "questionOverview.php?kartendeck_id=" + id;
}
function openLoescheKartendeck(id) {
  window.location.href = "lib/deleteKartendeck.php?kartendeck_id=" + id;
}
</script>

<?php
	include_once('lib/footer.php')
?>
</body>
</html>