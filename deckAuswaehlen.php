<?php
// check if user is logged in, if not redirect to login page
session_start();
/* if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} */

//include('lib/getFragenAnzahl.php');
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
    include('navbar.php')
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
                        // SQL Abfrage um die eigenen Kartendecks zu ermitteln
                        $sql = "SELECT kartendeck_id, kartendeck_name, kartendeck.modul_id, public, modulkuerzel, modulname FROM kartendeck JOIN modul WHERE (kartendeck.modul_id = modul.modul_id) AND (user_id = $user_id)";
                        $result = $conn->query($sql);

                        function getFragenAnzahl($kartendeck_id){

                            if(isset($kartendeck_id)) {
                        
                                $anzahl = mysqli_query($conn, "SELECT * FROM fragen WHERE kartendeck_id = $kartendeck_id");
                        
                                $num_rows = mysqli_num_rows($anzahl);
                        
                            } else {
                                $num_rows = 'ERROR';
                            }
                        
                            return $num_rows;
                        }

                        if ($result->num_rows > 0) {
                            // Ausgabe der SQL Abfrage
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row["kartendeck_name"]. "</td>
                                    <td>" . $row["modulkuerzel"]. "</td>
                                    <td>" . $row["modulname"]. "</td>
                                    <td>" . getFragenAnzahl($row["kartendeck_id"]). "</td>
                                    <td>
                                        <button type='button' class='buttonSpielen' value='" . $row["kartendeck_id"]. "'> Spielen </button>
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