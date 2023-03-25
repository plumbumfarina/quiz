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
    <title>Fragenübersicht</title>
</head>
<body>
    <header>
        <?php
            include_once('navbar.php')
        ?>
    </header>
	<main>
        <h1 class="formTitle">Fragen</h1>
            <table class="TabelleDeck">
                <thead class="THeadDeck">
                    <tr>
                        <th class="THDeck">Frage</th>
                        <th class="THDeck">Antwort Eins</th>
                        <th class="THDeck">Antwort Zwei</th>
                        <th class="THDeck">Antwort Drei</th>
                        <th class="THDeck">Antwort Vier</th>
                        <th class="THDeck">Richtige Antwort</th>
                        <th class="THDeck"></th>
                        <th class="THDeck"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once('lib/dbConnectorMYSQLI.php');

                        $kartendeck_id = $_GET['kartendeck_id'];

                        $sql = "SELECT fragen_id, fragentext, antwortEins, antwortZwei, antwortDrei, antwortVier, richtigkeit FROM fragen WHERE (kartendeck_id = $kartendeck_id)" ;
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            include_once('lib/dbConnectorMYSQLI.php');
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr class='TRDeck'>
                                    <td>" . $row["fragentext"]. "</td>
                                    <td>" . $row["antwortEins"]. "</td>
                                    <td>". $row["antwortZwei"]. "</td>
                                    <td>". $row["antwortDrei"]. "</td>
                                    <td>". $row["antwortVier"]. "</td>
                                    <td>" . $row["richtigkeit"]. "</td>
                                    <td>
                                        <button type='button' class='buttonBearbeiten' value='" . $row["fragen_id"]. "' onclick='openPage(" .  $row['fragen_id']. ")'> Bearbeiten </button>
                                    </td>
                                    <td>
                                        <button type='button' class='buttonLoeschen' value='" . $row["fragen_id"]. "' onclick='openPageFrageDelete(" . $row['fragen_id']. ")'> Löschen </button>
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
                                    <td>-</td>
                                </tr>";
                        }

                        
                    ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col">
                    <button type="button" onclick="openPageFrageAdd(<?php echo $kartendeck_id ?>)" class="buttonHinzufuegen"> Hinzufügen
                    </button>
                </div> 
            </div>
    </main>

    <script>
    function openPage(id) {
        window.location.href = "frageBearbeiten.php?fragen_id=" + id;
    }
    function openPageFrageDelete(id) {
        window.location.href = "lib/deleteFrage.php?fragen_id=" + id;
    }
    function openPageFrageAdd(id) {
        window.location.href= "addQuestion.php?kartendeck_id=" + id;
    }
    </script>
    <?php
        include_once('footer.php')
    ?>
</body>
</html>