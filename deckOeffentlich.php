<?php
// check if user is logged in, if not redirect to login page
session_start();
/* if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} */

include('lib/getFragenAnzahl.php');
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
    <title>Decks</title>
</head>
<body>
<?php
    include('navbar.php')
?>

<div>
    <div class="container mt-3">
        <h1 class="formTitle">Kartendecks</h1>
        <div class="btn-group">
            <button type='button' class='btn btn-outline-info' onclick="window.location.href = 'deckAuswaehlen.php';"> Nur eigene Kartendecks spielen </button>
            <button type='button' class='btn btn-outline-info'> Neues Kartendeck hinzufügen </button>
        </div>
        <br>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Deckname</th>
                        <th>Modulkürzel</th>
                        <th>Modulname</th>
                        <th>Anazhl Fragen</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "toor";
                        $dbname = "quiz";
                        $user_id = $_SESSION['userid'];

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        // SQL Abfrage um die öffentlichen Kartendecks zu ermitteln
                        $sql = "SELECT fragendeck_id, fragendeck_name, fragendeck.modul_id, public, modulkuerzel, modulname FROM fragendeck JOIN modul WHERE (fragendeck.modul_id = modul.modul_id) AND (public = TRUE)";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Ausgabe der SQL Abfrage 
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["fragendeck_name"]. "</td>
                                    <td>" . $row["modulkuerzel"]. "</td>
                                    <td>" . $row["modulname"]. "</td>
                                    <td>" . getFragenAnzahl($row["fragendeck_id"]). "</td>
                                    <td>
                                        <button type='button' class='btn btn-outline-success' value='" . $row["fragendeck_id"]. "'> Spielen </button>
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

</body>
</html>