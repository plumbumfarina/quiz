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
            include_once('lib/dbConnectorMYSQLI.php')
            include_once('lib/getFrage.php')
            include_once('lib/getAntworten.php')

            $kartendeck_id = $_GET['kartendeck_id'];

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
            echo $anzahlFragen;
            
			$currentFrage = getFrage($fragenListe[$currentIndex]);
            getFrage(4);
			echo $currentFrage; 
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