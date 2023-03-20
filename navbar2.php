

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Arrow</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <?php
        include('lib/getNickname.php');
    ?> 
    <nav class="navMenu">
        <ul>
            <li><a href="index.php">Startseite</a></li>
            <li><a href="decks.php">Meine Kartendecks</a></li>
            <li><a href="startGame.php">Neues Spiel</a></li>
            <li><a href="neuesDeck.html">Neues Deck</a></li>
            <li><a href="newDeck.php">Neues Deck php</a></li>
            <li><a href="createFragendeck.html">Neues Deck erstellen</a></li>
            <li><a href="fragenUebersicht.php">Fragenübersicht</a></li>
            <a class="navMenu-logout" href="lib/logout.php">LOGOUT</a>

        </ul>
        <p>Hallo <b> <?php echo $nickname; ?></b>!</p>
    </nav>
</body>
</html>
