<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}
?>

<!DOCTYPE html>
<!-- das ist die Codierung für den Tab bei der Internetseite des Quizes -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <title>Neues Spiel</title>

    <!-- Bootstrap -->
    <!-- das ist die Menüleiste -->
	<link href="css/style.css" rel="stylesheet">
  </head>
  <body>
  <header>
        <?php
            include_once('navbar.php')
        ?>
    </header>
	<main>
	
	<div class="container">
	
     <!-- das ist die Codierung für die "Herzlich Willkommen"-Leiste -->
			<div id="start_screen" class="jumbotren quiz_start" >
				<h1>Neues Spiel starten</h1>
				<h2>Bitte wähle einen Spielmodus aus</h2>
				<br>
				<br>
        <!-- das ist der "Jetzt starten"-Button-->
				<p style="text-align:center"><button id="start_btn" onclick="window.location.href='deckAuswaehlen.php';" class="btn btn-primary btn-lg" role="button">Einzelspieler</button></p>
				<p style="text-align:center"><button id="start_btn" onclick="window.location.href='multiPlayer.php';" class="btn btn-primary btn-lg start" role="button">Mehrspieler</button></p>	<!-- Hier muss noch die Klasse für die Mehrspieler rein -->
				


			</div>
	</div>
	</main>
    <!-- das ist die Codierung für die Verbindung mit Java Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   
    <script src="js/bootstrap.min.js"></script>
	<script src="js/quiz.js"></script>

	<?php
		include_once('footer.php')
	?>

  </body>
</html>