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

            //$kartendeck_id = 5 //$_GET['kartendeck_id'];

            $user_id = $_SESSION['userid'];
            $sql = "SELECT fragen_id FROM fragen WHERE kartendeck_id = 5";
            $result = $conn->query($sql);

            //$fragenListe = array();
			//$currentIndex = 0;

            if ($result->num_rows > 0) {
    // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo $row['fragen_id'];
                }
            } else {
                echo "";
            }

            while($row = $resultEins->fetch_assoc()) {
				echo $row['fragen_id'];
			}
			//foreach($fragenListe as $fL){
			//	echo $fL;
			//}
			//shuffle($fragenListe);
			//$anzahlFragen = count($fragenListe);
			//$currentFrage = getFrage($fragenListe[$currentIndex]);
			//$currentAntwort = getAntwort($fragenListe[$currentIndex]);
			//echo $currentFrage; 
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