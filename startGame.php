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
  </head>
  <body>
  <header>
    <?php
      include_once('lib/navbar.php')
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
				<p style="text-align:center"><button id="start_btn" onclick="window.location.href='userDeck.php';" role="button">Einzelspieler</button></p>
				<p style="text-align:center"><button id="start_btn" onclick="window.location.href='multiPlayer.php';" role="button">Mehrspieler</button></p>	<!-- Hier muss noch die Klasse für die Mehrspieler rein -->
			</div>
	  </div>
	</main>
	<?php
		include_once('lib/footer.php')
	?>
  </body>
</html>