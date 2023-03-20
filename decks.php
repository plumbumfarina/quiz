<?php
// check if user is logged in, if not redirect to login page
session_start();
/* if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} */

include('lib/getFragendeckname.php');
include('lib/getModulname.php');
include('lib/getFragenNumber.php');
include('lib/getFragenAnzahl.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
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

                        $sql = "SELECT fragendeck_id, fragendeck_name, fragendeck.modul_id, public, modulkuerzel, modulname FROM fragendeck JOIN modul WHERE (fragendeck.modul_id = modul.modul_id) AND (user_id = $user_id)";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["fragendeck_name"]. "</td>
                                    <td>" . $row["modulkuerzel"]. "</td>
                                    <td>" . $row["modulname"]. "</td>
                                    <td>" . getFragenAnzahl($row["fragendeck_id"]). "</td>
                                    <td>" . $row["public"]. "</td>
                                    <td>
                                        <button type='button' class='btn btn-outline-warning' value='" . $row["fragendeck_id"]. "' onclick='openPage(" .  $row['fragendeck_id']. ")'> Bearbeiten </button>
                                    </td>
                                    <td>
                                        <button type='button' class='btn btn-outline-danger' value='" . $row["fragendeck_id"]. "'> Löschen </button>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "0 results";
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
        <form action="addFragendeck.php" method="post">
            <div class="mb-3">
                <label for="deckName">Fragendeckname:</label>
                <input type="text" id="deckname" name="deckname" required class="form-control">
            </div>
            <div class="mb-3">
            <label for="modul">Wähle ein Modul aus:</label>
                <select id="modul" name="modul" class="form-select">

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

                        $sql = "SELECT modulkuerzel FROM modul" ;
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option>" . $row["modulkuerzel"]. "</option>";
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
                <div class="col">
                    <button type="button" class="btn btn-outline-danger"> Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openPage(id) {
  window.location.href = "fragenUebersicht.php?fragendeck_id=" + id;
}
</script>
</body>
</html>