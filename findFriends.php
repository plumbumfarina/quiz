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
        <h1>Freunde</h1>
        <div class="ContainerDeck" style="padding:2px;">
            <h2>Bestehende Freundschaften</h2>
        </div>
        <br>
        <table class="TabelleDeck">
            <thead class="THeadDeck">
                <tr>
                    <th class="THDeck">Benutzer</th>
                    <th class="THDeck">Gewonnen</th>
                    <th class="THDeck">Verloren</th>
                    <th class="THDeck">Unentschieden</th>
                    <th class="THDeck"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="TRDeck">
                    <th>maxMustermann</th>
                    <th>9</th>
                    <th>1</th>
                    <th>2</th>
                    <th>
                        <button class="buttonBlue"> Herausfordern </button>
                    </th>
                </tr>
                <tr class="TRDeck">
                    <th>8055</th>
                    <th>2</th>
                    <th>9</th>
                    <th>5</th>
                    <th>
                        <button class="buttonBlue"> Herausfordern </button>
                    </th>
                </tr>
            </tbody>
        </table class="TableDeck">
        <br>
        <div class="ContainerDeck" style="padding:2px;">
            <h2>Freund Finden</h2>
            <form method="post" class="formDeck" style="padding:5px">
                <label for="deckname" class="labelDeck">Username :</label>
                <input type="text" name="deckname" class="inputDeck">
                <button class="buttonYellow"> Freund Finden </button>
            </form>
        </div>
        <br>
        <table class="TabelleDeck">
            <thead class="THeadDeck">
                <tr>
                    <th class="THDeck">Benutzername</th>
                    <th class="THDeck">E-Mail</th>
                    <th class="THDeck"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="TRDeck">
                    <td>kunibert</td>
                    <td>kunibert@gmaily.com</td>
                    <td>
                        <button class="buttonBlue"> Freundschaftsanfrage senden! </button>
                    </td>
                </tr> 
                <tr class="TRDeck">
                    <td>dagobert</td>
                    <td>dagobertDuck@gmaily.com</td>
                    <td>
                        <button class="buttonBlue"> Freundschaftsanfrage senden! </button>
                    </td>
                </tr> 
                <tr class="TRDeck">
                    <td>homer</td>
                    <td>homerSimpson@gmaily.com</td>
                    <td>
                        <button class="buttonBlue"> Freundschaftsanfrage senden! </button>
                    </td>
                </tr> 
            </tbody>
        </table>
    </main>
    <?php
		include_once('lib/footer.php')
	?>
</body>
</html>