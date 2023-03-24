<!DOCTYPE html>
<!-- Hier ist der Tab für die Internetseite vom Quiz -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <title>Projekt</title>


  </head>
  <body>
	<div class="container">
  <?php
			include_once('navbar.php')
		?>	
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Quiz</a>
					<p>Menü</p>
				</div>
			</div>
		</nav>
			
            <!-- Hier ist die "Quiz vorbei"-Leiste-->
			<div id="over" class="jumbotren quiz_end">
				<h1>Quiz vorbei...</h1>
                <!-- Hier ist der Punktestand -->
				<p>Dein Punktestand ist: <span id="endpoints">0</span> von <span id="possiblepoints">0</span></p>
                <!-- Hier ist der "Nochmal starten"-Button-->
				<p><button class="restart btn btn-primary btn-lg" role="button">Nochmal starten</button></p>
			</div>
	</div>

    <!-- Hier ist die Verbindung zu Java Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   
    <script src="js/bootstrap.min.js"></script>
	<script src="js/quiz.js"></script>


  <?php
			include_once('footer.php')
		?> 
  </body>
</html>
