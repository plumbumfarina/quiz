<?php
// check if user is logged in, if not redirect to login page
/*session_start();
    if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}*/

include_once('lib/getFragenAnzahl.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>
<body>
    <header>
        <?php
            include_once('navbar.php')
        ?>
    </header>
	<main>
        <h1>Freies Spiel eröffnen</h1>
    </main>
    <?php
        include_once('footer.php')
    ?>
</body>
</html>