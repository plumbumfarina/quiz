<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<nav class="navMenu">
    <ul>
        <li><a href="index.php">Startseite</a></li>
        <li><a href="decks.php">Meine Kartendecks</a></li>
        <li><a href="startGame.php">Neues Spiel</a></li>        
        <a class="navMenu-logout" href="lib/logout.php"><span class="material-icons-outlined">logout</span></a>
    </ul>
    <?php 
        session_start();
        if(isset($_SESSION['nickname'])) {
            echo " <p>Hallo <b>" . $_SESSION['nickname']."</b>!</p>";
         } 
    ?>
</nav>