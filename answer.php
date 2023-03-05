<!DOCTYPE html>
<!-- hier ist die Codierung für die Benennung des Tabs bei einer Internetseite -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <title>Projekt</title>

    <!-- Bootstrap -->
    <!-- hier ist die Codierung für das Menü-Band oben -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  </head>
  <body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Quiz</a>
					<p>Menü</p>
				</div>
			</div>
		</nav>
    
    <!-- hier ist die Codierung für den Fragebalken -->	
			<div id="question" class="jumbotren">
				<h2>Frage <span id="qra">0</h2>
				<p id="question_text">Dies ist die Frage.</p>
        
        <!-- hier ist die Codierung für die 4 Antwort-Möglichkeiten-->
				<div class="row">
	<!-- das hier ist die Antwort A -->
           				<div class="col-md-6">
						<p><button id="answer"_a_btn" class="answer btn btn-default btn-lg btn-black" role="button">
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
							<span id="commit_text">Antworten</span><button></p>
              <!-- das hier ist der Weiter-Button -->
						<p><button id="answer_commit_btn" class="btn btn-primary btn-lg btn-black" role="button"><span>Weiter</span><button></p>
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