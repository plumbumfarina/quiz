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
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	
	<script src="js/quiz.js" type="text/javascript"></script>
	<script src="js/script.js"></script>

	<?php
			include('footer.php')
	?>

  </body>

</html>
