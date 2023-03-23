<?php
// check if user is logged in, if not redirect to login page
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
} 

include('lib/getFragenListe.php');
include('lib/getFrage.php');
include('lib/getAntworten.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<title>Projekt</title>
</head>
<body>
	<?php
		include('navbar.php');
	?>

	<div>
		<h1> Frage </h1>
		<form>
		<?php 
			include('lib/dbConnectormysqli');

			$kartendeck_id = $_GET['kartendeck_id'];

			$fragenListe = array();
				
			$abfrageEins = "SELECT fragen_id FROM fragen WHERE kartendeck_id = $kartendeck_id;";
			$resultEins = mysqli_query($conn, $abfrageEins);

			while($row = mysqli_fetch_assoc($resultEins)) {
				$fragenListe[] = $row['fragn_id'];
			}

			shuffle($fragenListe);



	
		?>

	</div>
    <!-- hier ist die Codierung für den Fragebalken -->	
			<div id="question">
				<h2>Frage</h2>
				<p id="question_text">Dies ist die Frage.</p>
        
    <!-- hier ist die Codierung für die 4 Antwort-Möglichkeiten-->
				<div class="row">
	<!-- das hier ist die Antwort A -->
           			<div class="col-md-6">
						<p><button id="answer_a_btn" class="answer btn btn-default btn-lg btn-black" role="button">
						A: <span id="answer_a">Antwort</span></button></p>
					</div>
    <!-- das hier ist Antwort B -->
					<div class="col-md-6">
						<p><button id="answer_a_btn" class="answer btn btn-default btn-lg btn-black" role="button">
						B: <span id="answer_a">Antwort</span></button></p>
					</div>
        		</div>
	<!-- das hier ist Antwort C -->			
				<div class="row">
					<div class="col-md-6">
						<p><button id="answer_a_btn" class="answer btn btn-default btn-lg btn-black" role="button">
						C: <span id="answer_a">Antwort</span></button></p>
					</div>
    <!-- das hier ist Antwort D -->
					<div class="col-md-6">
						<p><button id="answer_a_btn" class="answer btn btn-default btn-lg btn-black" role="button">
						D: <span id="answer_a">Antwort</span></button></p>
					</div>
				</div>
    <!-- das hier ist der Antwort-Button -->
				<div class="row">
					<div class="col-md-10">
					</div>
					<div class="col-md-2">
						<p><button id="answer_commit_btn" class="btn btn-primary btn-lg btn-black" role="button">
							<span id="commit_text">Antworten</span></button></p>
    <!-- das hier ist der Weiter-Button -->
						<p><button id="answer_commit_btn" class="btn btn-primary btn-lg btn-black" role="button"><span>Weiter</span></button></p>
					</div>
				</div>
			</div>
	</div>

    <!-- hier ist die Verbindung zu Java Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
    <script src="js/bootstrap.min.js"></script>
	<script src="js/quiz.js"></script>
  </body>
</html>
