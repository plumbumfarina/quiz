<?php
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
    <title>Settings</title>
</head>
<body>
<?php
    include('navbar.php')
?>	
		
    <h1>Hier kannst Du Einstellungen vornehmen</h1>
    
    <div class="switch-container">
        <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
        <span class="label-text">Dark-Modus aktivieren</span>
    </div>
    <div class="switch-container">
        <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
        <span class="label-text">Töne aktivieren</span>
    </div>
    <div class="switch-container">
        <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
        <span class="label-text">Benachrichtigungen aktivieren</span>
    </div>
    <div class="switch-container">
        <label class="switch">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
        <span class="label-text">Automatische Posts auf Instagram</span>
    </div>



<?php
    include('footer.php')
?>
		
		
		   
</body>
</html>