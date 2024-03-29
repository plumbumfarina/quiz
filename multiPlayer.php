<?php
// check if user is logged in, if not redirect to login page
  session_start();
    if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}
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
            include_once('lib/navbar.php')
        ?>
    </header>
	<main>
        <div class="buttonContainer">
            <h1>Mehrspieler Modus</h1>
                <p style="text-align:center"><button id="start_btn" onclick="window.location.href='createGame.php';" role="button">Freies Spiel eröffnen</button></p>
                <p style="text-align:center"><button id="start_btn" onclick="window.location.href='joinGame.php';"  role="button">Freiem Spiel beitreten</button></p>                 
                <p style="text-align:center"><button id="start_btn"  onclick="window.location.href='findFriends.php';" role="button">Freund/in finden</button></p>
        </div>
    </main>
    <?php
        include_once('lib/footer.php')
    ?>
</body>
</html>