<nav class="navMenu">
    <ul>
        <li><a href="index.php">Startseite</a></li>
        <li><a href="decks.php">Meine Kartendecks</a></li>
        <li><a href="startGame.php">Neues Spiel</a></li>
        <a class="navMenu-logout" href="lib/logout.php">LOGOUT</a>

    </ul>
    <p>Hallo <b> <?php echo $_SESSION['nickname']; ?></b>!</p>
</nav>