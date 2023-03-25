<?php
// session starten
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>
<body>
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
</body>
</html>