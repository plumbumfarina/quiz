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
  	<header>
        <?php
            include_once('navbar.php')
        ?>
    </header>
	<main>
			
            <!-- Hier ist die "Quiz vorbei"-Leiste-->
			<div id="over" class="jumbotren quiz_end">
				<h1>Quiz vorbei...</h1>
                <!-- Hier ist der Punktestand -->
				<p>Dein Punktestand ist: <span id="endpoints">0</span> von <span id="possiblepoints">0</span></p>
                <!-- Hier ist der "Nochmal starten"-Button-->
				<p><button class="restart btn btn-primary btn-lg" role="button">Nochmal starten</button></p>
			</div>
	</main>

	<?php
			include_once('footer.php')
	?> 
  </body>
</html>
