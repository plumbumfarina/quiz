<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}
?>

<!Doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1-transitional.dtd">

<html cmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projekt</title>

    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	
	
  </head>
  <body>
	<div class="container">
		<?php
			include('navbar.php')
		?>
	</div>	
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	
	<script src="js/quiz.js" type="text/javascript"></script>
	<script src="js/script.js"></script>

	<?php
			include('footer.php')
		?>

  </body>

</html>
