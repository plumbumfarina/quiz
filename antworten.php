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
            include_once('lib/dbConnectorMYSQLI.php');

            function getFrage($fragen_id){
                global $conn;
            // Prüfung ob eine angegeben wurde 
              if(isset($fragen_id)) {
            // Abfrage aller Informationen einer Frage
                $sqlFrage = "SELECT fragentext FROM fragen WHERE fragen_id = $fragen_id";
                $resultFrage = $conn->query($sqlFragen);
                  if ($resultFrage->num_rows > 0) {
            // Ausgabe des Tabelleninhaltes
                    while($rowFrage = $resultFrage->fetch_assoc()) {
                        $fragentext = $rowFrage['fragentext'];
                    } 
                  } else {
                    echo "Kein Fragentext gefunden.";
                  }
              } else {
                echo "Keine Frage angegeben.";
              }
            
              return $fragentext;
            
            }
            

            $kartendeck_id = 6; //$_GET['kartendeck_id'];

            $user_id = $_SESSION['userid'];
            $sql = "SELECT fragen_id FROM fragen WHERE kartendeck_id = $kartendeck_id";
            $result = $conn->query($sql);

            $fragenListe = array();
			$currentIndex = 0;

            if ($result->num_rows > 0) {
    // output data of each row
                while($row = $result->fetch_assoc()) {
                    $fragenListe[] = $row['fragen_id'];
                }
            } else {
                echo "";
            }

			foreach($fragenListe as $fL){
			    echo $fL;
			}
			//shuffle($fragenListe);
			$anzahlFragen = count($fragenListe);
            echo $fragenListe[$currentIndex];
			$currentFrage = getFrage($fragenListe[$currentIndex]);
			//$currentAntwort = getAntwort($fragenListe[$currentIndex]);
			echo $currentFrage; 
			//foreach($currentAntwort as $cA){
			//	echo $cA;
			//}
			$conn->close();
                        
        ?>
    </div>
</div>


<?php
	include_once('footer.php')
?>
</body>
</html>