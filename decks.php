<?php
// check if user is logged in, if not redirect to login page
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} 
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
        <h1 class="form__title">Kartendecks</h1>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Deckname</th>
                        <th>Modulkürzel</th>
                        <th>Modulname</th>
                        <th>Anazhl Fragen</th>
                        <th>öffentlich</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('lib/dbConnector.php');
                        $sql = "SELECT kartendeck_id, kartendeck_name, kartendeck.modul_id, public, modulkuerzel, modulname FROM kartendeck JOIN modul WHERE (kartendeck.modul_id = modul.modul_id) AND (user_id = $user_id) ORDER BY modulkuerzel ASC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["kartendeck_name"]. "</td>
                                    <td>" . $row["modulkuerzel"]. "</td>
                                    <td>" . $row["modulname"]. "</td>
                                    <td>" . getFragenAnzahl($row["kartendeck_id"]). "</td>
                                    <td>" . $row["public"]. "</td>
                                    <td>
                                        <button type='button' class='btn btn-outline-warning' value='" . $row["kartendeck_id"]. "' onclick='openBearbeiteKartendeck(" .  $row['kartendeck_id']. ")'> Bearbeiten </button>
                                    </td>
                                    <td>
                                        <button type='button' class='btn btn-outline-danger' value='" . $row["kartendeck_id"]. "' onclick='openLoescheKartendeck(" .  $row['kartendeck_id']. ")'> Löschen </button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr>
                                    <td>-</td>
                                    <td>-</td>
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
<div>
    <div class="container mt-3">
        <h1 class="form__title">Kartendeck hinzufügen</h1>
        <form action="lib/addkartendeck.php" method="post">
            <div class="mb-3">
                <label for="deckName">Kartendeckname:</label>
                <input type="text" id="deckname" name="deckname" required class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-check-label" for="public">Willst du das Kartendeck für alle spielbar machen?</label>
                <input type="radio" name="public" value="TRUE" required> Ja </input>
                <input type="radio" name="public" value="FALSE"> Nein </input>
            </div>
            <div class="mb-3">
            <label for="modul">Wähle ein Modul aus:</label>
                <select id="modul" name="modul" class="form-select">
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
                        $sql = "SELECT modulname FROM modul" ;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option>" . $row["modulname"]. "</option>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>
                </select>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-outline-success"> Anlegen
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function openBearbeiteKartendeck(id) {
  window.location.href = "fragenUebersicht.php?kartendeck_id=" + id;
}
function openLoescheKartendeck(id) {
  window.location.href = "lib/deletekartendeck.php?kartendeck_id=" + id;
}
</script>

<?php
	include('footer.php')
?>
</body>
</html>