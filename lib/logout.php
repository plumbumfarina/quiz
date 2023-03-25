<?php
// session starten
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logout</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>
<body>
    <header>
        <?php
            include_once('lib/navbar.php')
        ?>
    </header>
	<div class="containerLogin">
		<h1 class="formTitle">Logout</h1>
		<p>Are you sure you want to logout?</p>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<button type="submit">Logout</button>
		</form>
	</div>
    <?php
	// Prüfung ob Logout geclickt wurde
	if(isset($_POST['logout'])) {
		// Session zerstören
		session_start();
		session_destroy();
		
        sleep(0.1);
		// Zur Startseite weiterleiten
		header("Location: ../login.php");
		exit;
	}
	?>
    <?php
		include_once('footer.php')
	?>
</body>
</html>