<nav class="navMenu">
    <ul>
        <li><a href="index.php">Startseite</a></li>
        <li><a href="decks.php">Meine Kartendecks</a></li>
        <li><a href="startGame.php">Neues Spiel</a></li>

        <?php 
            session_start();
            if(isset($_SESSION['nickname'])) {
                echo " <li>Hallo <b>" . $_SESSION['nickname']."</b>!</li>";
            } 
        ?>
        
        <a class="navMenu-logout" href="lib/logout.php">LOGOUT</a>

    </ul>
</nav>