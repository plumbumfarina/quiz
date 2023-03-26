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
        <h1>Freunde</h1>
        <div class="ContainerDeck">
            <h2>Bestehende Freundschaften</h2>
            <table class="TabelleDeck">
                <thead class="THeadDeck">
                    <tr>
                        <th class="THDeck">User</th>
                        <th class="THDeck">Win</th>
                        <th class="THDeck">Loose</th>
                        <th class="THDeck">Tie</th>
                        <th class="THDeck"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="TRDeck">
                        <th>maxMustermann</th>
                        <th>9</th>
                        <th>1</th>
                        <th>2</th>
                        <th>
                            <button class="buttonBlue"> Herausfordern </button>
                        </th>
                    </tr>
                    <tr class="TRDeck">
                        <th>8055</th>
                        <th>2</th>
                        <th>9</th>
                        <th>5</th>
                        <th>
                            <button class="buttonBlue"> Herausfordern </button>
                        </th>
                    </tr>
                </tbody>
            </table class="TableDeck">
        </div>
        <br>
        <div class="ContainerDeck" style="padding:10px;">
            <h2>Freund Finden</h2>
            <form method="post" class="formDeck" style="padding:5px">
                <label for="deckname" class="labelDeck">Kartendeckname:</label>
                <input type="text" name="deckname" class="inputDeck">
                <button class="buttonYellow"> Freund Finden </button>
            </form>
        </div>
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
                                        <button type='button' class='buttonBlue' value='" . $row["kartendeck_id"]. "' onclick='openPageGame(" .  $row['kartendeck_id']. ")'". ($fragenAnzahl == 0 ? " disabled" : "") ."> Spiel eröffnen </button>
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