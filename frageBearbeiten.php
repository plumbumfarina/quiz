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
    <title>Frage</title>
</head>
<body>
<?php
    include('navbar.php')
?>


<div>
    <div class="container mt-9">
        <h1 class="form__title">Frage bearbeiten</h1>
            <form>
                <?php
                    $fragen_id = $_GET['fragen_id'];

                    $servername = "localhost";
                    $username = "root";
                    $password = "toor";
                    $dbname = "quiz";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT fragen_id, fragentext, antwortEins, antwortZwei, antwortDrei, antwortVier, richtigkeit FROM new_table WHERE (fragen_id = $fragen_id)" ;
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "
                                <label for='fragenID' class='form-label'> Fragen ID:</label>
                                <input type='text' class='form-control' value='" . $row["fragen_id"]. "'disabled></input>
                                <label for='frage' class='form-label'> Frage:</label>
                                <input type='text' class='form-control' value='" . $row["fragentext"]. "'></input>
                                <label for='frage' class='form-label'> Antwort 1:</label>
                                <input type='text' class='form-control' value='" . $row["antwortEins"]. "'></input><br>
                                <input type='radio' id='richtigkeitEins' name='richtigkeit' value='RichtigeAntwort'>
                                <label for='richtigkeitEins'>Richtige Antwort</label><br><br>
                                <label for='frage' class='form-label'> Antwort 2:</label>
                                <input type='text' class='form-control' value='" . $row["antwortZwei"]. "'></input><br>
                                <input type='radio' id='richtigkeitZwei' name='richtigkeit' value='RichtigeAntwort'>
                                <label for='richtigkeitZwei'>Richtige Antwort</label><br><br>
                                <label for='frage' class='form-label'> Antwort 3:</label>
                                <input type='text' class='form-control' value='" . $row["antwortDrei"]. "'></input><br>
                                <input type='radio' id='richtigkeitDrei' name='richtigkeit' value='RichtigeAntwort'>
                                <label for='richtigkeitDrei'>Richtige Antwort</label><br><br>
                                <label for='frage' class='form-label'> Antwort 4:</label>
                                <input type='text' class='form-control' value='" . $row["antwortVier"]. "'></input><br>
                                <input type='radio' id='richtigkeitVier' name='richtigkeit' value='RichtigeAntwort'>
                                <label for='richtigkeitVier'>Richtige Antwort</label><br><br>
                            ";
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                ?>
                <div>
                    <button type="button" class="btn btn-outline-success"> 
                        Ändern 
                    </button>
                    <button type="button" class="btn btn-outline-danger"> 
                        Abbrechen 
                    </button>
                </div>
            </form>
    </div>
</div>
</body>
</html>
