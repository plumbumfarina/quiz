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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	
	
  </head>
  <body>
	<?php
		include('navbar.php')
	?>
		<div class="container">
		

			<div id="start_screen" class="jumbotren quiz_start" >
				<h1>Herzlich Willkommen zum Quiz</h1>
				<br>
				<br>
				<div class="button-container">
					<p style="text-align:center"><button id="start_btn" onclick="window.location.href='startGame.php';" href="startGame.php" class="btn btn-primary btn-lg start" role="button">Neues Spiel starten</button></p>	  <!-- Der Button muss auf die Seite GameStart führen und die andern Button auch auf die jeweiligen Seiten -->
					<p style="text-align:center"><button id="kartendecks_btn" onclick="window.location.href='decks.php';" href="decks.php" class="btn btn-primary btn-lg kartendeck" role="button">Kartendecks</button></p>	
					<p style="text-align:center"><button id="einstellungen_btn" onclick="window.location.href='Benutzereinstellungen.php';" href="Benutzereinstellungen.php" class="btn btn-primary btn-lg einstellungen" role="button">Benutzereinstellungen</button></p>	
				</div>
			</div>
			
			<div id="over" class="jumbotren quiz_end" hidden>
				<h1>Quiz vorbei...</h1>
				<p>Dein Punktestand ist: <span id="endpoints">0</span> von <span id="possiblepoints">0</span></p>
				<p><button id="restart_btn" class="restart btn btn-primary btn-lg" role="button">Nochmal starten</button></p>
			</div>
			
			<div id="question" class="jumbotren" hidden>
				<h2>Frage <span id="qno">0</span></h2>
				<p id="question_text">Frage?</p>
				<div class="row">
					<div class="col-md-6">
						<p><button id="answer_a_btn" class="answer btn btn-default btn-lg btn-block" role="button">A: <span id="answer_a">Antwort</span></button></p>
					</div>
					<div class="col-md-6">
						<p><button id="answer_b_btn" class="answer btn btn-default btn-lg btn-block" role="button">B: <span id="answer_b">Antwort</span></button></p>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<p><button id="answer_c_btn" class="answer btn btn-default btn-lg btn-block" role="button">C: <span id="answer_c">Antwort</span></button></p>
					</div>
					<div class="col-md-6">
						<p><button id="answer_d_btn" class="answer btn btn-default btn-lg btn-block" role="button">D: <span id="answer_d">Antwort</span></button></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
					</div>
					<div class="col-md-2">
						<p><button id="answer_commit_btn" class="btn btn-primary btn-lg btn-block" role="button"><span id="commit_text">Antworten</span></button></p>
						<p><button id="continue_btn" class="btn btn-primary btn-lg btn-block" role="button"><span id="commit_text" >Weiter</span></button></p>
					</div>
				</div>
			</div>
	</div>	
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	
	<script src="js/quiz.js" type="text/javascript"></script>
	<script src="js/script.js"></script>

	<?php
			include('footer.php')
		?>

  </body>

</html>
