<?php
/*session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}*/
?>

<!Doctype html>

<html cmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projekt</title>

	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	
	
  </head>
  <body>
	<?php
		include('navbar.php');
	?>
  
  	<div id="start_screen" class="jumbotren quiz_start" >
		<h1>Herzlich Willkommen zum Quiz</h1>
		<br>
		<br>
		<div class="buttonContainer">
			<p style="text-align:center"><button id="start_btn" onclick="window.location.href='startGame.php';" href="startGame.php" class="btn btn-primary btn-lg start" role="button">Neues Spiel starten</button></p>	  <!-- Der Button muss auf die Seite GameStart führen und die andern Button auch auf die jeweiligen Seiten -->
			<p style="text-align:center"><button id="kartendecks_btn" onclick="window.location.href='decks.php';" href="decks.php" class="btn btn-primary btn-lg kartendeck" role="button">Kartendecks</button></p>	
			<p style="text-align:center"><button id="einstellungen_btn" onclick="window.location.href='settings.php';" class="btn btn-primary btn-lg einstellungen" role="button">Benutzereinstellungen</button></p>	
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	
	<script src="js/quiz.js" type="text/javascript"></script>
	<script src="js/script.js"></script>

	<?php
		include('footer.php');
	?>

  </body>

</html>
