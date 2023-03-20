<?php
// check if user is logged in, if not redirect to login page
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}

include('lib/getFragendeckname.php');
include('lib/getModulname.php');
include('lib/getFragenNumber.php');
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
    <div class="container mt-9">
        <h1 class="form__title">Fragen</h1>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Frage</th>
                        <th>Antwort Eins</th>
                        <th>Antwort Zwei</th>
                        <th>Antwort Drei</th>
                        <th>Antwort Vier</th>
                        <th>Richtige Antwort</th>
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

                        $fragendeck_id = $_GET['fragendeck_id'];

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT fragen_id, fragentext, antwortEins, antwortZwei, antwortDrei, antwortVier, richtigkeit FROM new_table WHERE (fragendeck_id = $fragendeck_id)" ;
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["fragentext"]. "</td>
                                    <td>" . $row["antwortEins"]. "</td>
                                    <td>". $row["antwortZwei"]. "</td>
                                    <td>". $row["antwortDrei"]. "</td>
                                    <td>". $row["antwortVier"]. "</td>
                                    <td>" . $row["richtigkeit"]. "</td>
                                    <td>
                                        <button type='button' class='btn btn-outline-warning' value='" . $row["fragen_id"]. "' onclick='openPage(" .  $row['fragen_id']. ")'> Bearbeiten </button>
                                    </td>
                                    <td>
                                        <button type='button' class='btn btn-outline-danger' value='" . $row["fragendeck_id"]. "' onclick='openPage(" . $row['fragen_id']. ")'> Löschen </button>
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
            <div class="row">
                <div class="col">
                    <button type="button" onclick="openPageFrageAdd(<?php echo $fragendeck_id; ?>)" class="btn btn-outline-success"> Hinzufügen
                    </button>
                </div> 
            </div>
    </div>
</div>

<script>
function openPage(id) {
    window.location.href = "frageBearbeiten.php?fragen_id=" + id;
}
function openPage(id) {
    window.location.href = "deleteFrage.php?fragen_id=" + id;
}
function openPageFrageAdd(id) {
    window.location.href= "addQuestion.php?fragendeck_id=" + id;
}
</script>
</body>
</html>