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
    <title>Update Frage</title>
</head>
<body>
    <header>
        <?php
            include_once('navbar.php')
        ?>
    </header>
	<main>
        <h1 class="formTitle">Frage bearbeiten</h1>
        <div class="ContainerDeck">
            <form action="lib/updateFrage.php" method="post" class="formDeck">
                <?php
                    $fragen_id = $_GET['fragen_id'];

                    include_once('lib/dbConnectorMYSQLI.php');
                    
                    // SQL Abfrage der entsprechenden Frage anhand der Fragen_ID
                    $sql = "SELECT fragen_id, fragentext, kartendeck_id, antwortEins, antwortZwei, antwortDrei, antwortVier, richtigkeit FROM fragen WHERE fragen_id = $fragen_id" ;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Ausgabe der SQL Abfrage in das Formular
                        while($row = $result->fetch_assoc()) {
                            // SQL Abfrage in Variablen schreiben
                            $fragen_id = $row['fragen_id'];
                            $fragentext = $row['fragentext'];
                            $kartendeck_id = $row['kartendeck_id'];
                            $antwortEins = $row['antwortEins'];
                            $antwortZwei = $row['antwortZwei'];
                            $antwortDrei = $row['antwortDrei'];
                            $antwortVier = $row['antwortVier'];
                            $richtigkeit = $row['richtigkeit'];
                        }
                    } else {
                        // Ansicht falls die Frage nicht gefunden wird
                        echo "0 results";
                    }

                    
                ?>
                <label for='fragenID' hidden> Fragen ID:</label>
                <input type='text' class='inputDeck' name='fragenID' value='<?php echo $fragen_id; ?>'hidden></input>
                
                <label for='frage' class='labelDeck'> Frage:</label>
                <input type='text' class='inputDeck' name='fragentext' value='<?php echo $fragentext; ?>'></input>
                <br>
                <label for='frage' class='labelDeck'> Antwort 1:</label>
                <div style='display: flex; align-items: center;'>
                    <input type='text' class='inputDeck' name='Antwort1' value='<?php echo $antwortEins; ?>'>
                    <input type='radio' name='richtigkeit' value='1' <?php if($richtigkeit == '1') echo 'checked'; ?>>
                    <label>Richtige Antwort</label>
                </div>
                <br>
                <label for='frage' class='labelDeck'> Antwort 2:</label>
                <div style='display: flex; align-items: center;'>
                    <input type='text' class='inputDeck' name='Antwort2' value='<?php echo $antwortZwei; ?>'></input>
                    <input type='radio' name='richtigkeit' value='2' <?php if($richtigkeit == '2') echo 'checked'; ?>> 
                    <label>Richtige Antwort</label>
                </div>
                <br>
                <label for='frage' class='labelDeck'> Antwort 3:</label>
                <div style='display: flex; align-items: center;'>
                    <input type='text' class='inputDeck' name='Antwort3' value='<?php echo $antwortDrei; ?>'></input>
                    <input type='radio' name='richtigkeit' value='3' <?php if($richtigkeit == '3') echo 'checked'; ?>>
                    <label>Richtige Antwort</label>
                </div>
                <br>
                <label for='frage' class='labelDeck'> Antwort 4:</label>
                <div style='display: flex; align-items: center;'>
                    <input type='text' class='inputDeck' name='Antwort4' value='<?php echo $antwortVier; ?>'></input>
                    <input type='radio' name='richtigkeit' value='4' <?php if($richtigkeit == '4') echo 'checked'; ?>>
                    <label>Richtige Antwort</label><br><br> 
                </div>
                <br>                
                <button style="width:33%;" type="submit" class="buttonGreen"> Speichern </button>
                <button style="width:33%;" type="button" class="buttonRed" onclick="openPage(<?php echo $kartendeck_id ?>)">Abbrechen</button>
            </form>
        </div>
    </main>
    <script>
    function openPage(id) {
        window.location.href = "fragenUebersicht.php?kartendeck_id=" + id;
    }
    </script>
    <footer>

    </footer>
</body>
</html>
