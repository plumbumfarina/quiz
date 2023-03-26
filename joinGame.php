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
        <h1>Freiem Spiel beitreten</h1>
        <div class="ContainerDeck">
            <table class="TableDeck">
                <thead>
                    <tr>
                        <th>Modul</th>
                        <th>Anzahl Fragen</th>
                        <th>User</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Einführung in die Wirtschaftinformatik</th>
                        <th>25</th>
                        <th>maxMustermann</th>
                        <th>
                            <button class="buttonBlue"> wartet auf Spieler </button>
                        </th>
                    </tr>
                    <tr>
                        <th>Betriebswirtschaftslehre</th>
                        <th>18</th>
                        <th>8055</th>
                        <th>
                            <button class="buttonBlue"> wartet auf Spieler </button>
                        </th>
                    </tr>
                </tbody>
            </table class="TableDeck">
        </div>
        <div class="ContainerDeck">
            <p style="text-align:center"><button id="start_btn" role="button">Zufälligem Spiel beitreten</button></p>
        </div>
    </main>
    <?php
        include_once('lib/footer.php')
    ?>
</body>
</html>