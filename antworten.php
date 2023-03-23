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
    
    <title>Frage</title>
</head>
<body>
<?php
    include_once('navbar.php')
?>
<div>
    <div class="container mt-3">
        <h1 class="form__title">Frage</h1>
        <?php
// Datenbank-Verbindung
            $servername = "localhost";
            $username = "root";
            $password = "toor";
            $dbname = "ProjektQuiz";
        
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
// wichtige Variablen 
            $kartendeck_id = $_GET['kartendeck_id'];
            $user_id = $_SESSION['userid'];
            $fragenListe = array();
			$currentIndex = 0;

//SQL Abfrage für alle Fragen-IDs
            $sql = "SELECT fragen_id FROM fragen WHERE kartendeck_id = $kartendeck_id";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $kartendeck_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $fragenListe[] = $row['fragen_id'];
                }
            } else {
                echo "Keine Fragen gefunden!";
            }    

// Funktion um die aktuelle Frage herauszufinden
            function getFrage($conn, $fragen_id){
            // Prüfung ob eine Fragen-ID angegeben wurde 
            //if(isset($fragen_id)) {
                $sqlFrage = "SELECT fragentext FROM fragen WHERE fragen_id = $fragen_id";
                $resultFrage = $conn->query($sqlFragen);

                $rowFrage = $resultFrage->fetch_assoc();
                $fragentext = $rowFrage['fragentext']; 

            //} else {
            //    echo "Keine Frage angegeben.";
            //}

            return $fragentext;
            }
            

// Ausgabe aller Fragen-IDs
			foreach($fragenListe as $fL){
			    $currentFrage = getFrage($conn, $fL);
                echo $currentFrage;
			}
// Zufällige Reihenfolge der Fragen-IDs
			shuffle($fragenListe);
// Länge des Array = Anzahl der Fragen-IDs
			$anzahlFragen = count($fragenListe);
            echo $anzahlFragen;

// Aktuelle Antworten
            $currentAntwort = getAntwort(4);
			foreach($currentAntwort as $cA){
				echo $cA;
			}

			$conn->close();
                        
        ?>
    </div>
</div>


<?php
	include_once('footer.php')
?>
</body>
</html>