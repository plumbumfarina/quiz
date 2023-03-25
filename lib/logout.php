<?php
// session starten
session_start();

?>
 <?php
        // Prüfung ob Logout geclickt wurde
        if(isset($_POST['logout'])) {
            // Session zerstören
            session_start();
            session_destroy();
            
            // Zur Startseite weiterleiten
            header("Location: ../login.php");
            exit;
        }
    ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style.css" type="text/css" media="screen"/>
        <title>Logout</title>
    </head>
    <body>
        <header>
            <?php
                include_once('navbar.php')
            ?>
        </header>
        <div class="containerLogin">
            <h1 class="formTitle">Logout</h1>
            <h2>Willst du dich wirklich ausloggen?</h2>
            <form action="?logout=1" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
       
        
        <?php
            include_once('footer.php')
        ?>
    </body>
</html>