<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}
?>

<?php


include_once('lib/dbConnectorPDO.php');
if(isset($_GET['change-password'])) {
    if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        $userId = $_SESSION['userid'];

        $statement = $conn->prepare("SELECT * FROM user WHERE user_id = :user_id");
        $result = $statement->execute(array('user_id' => $userId));
        $user = $statement->fetch();

        // Check if old password is correct
        if ($user !== false && ($oldPassword == $user['passwort'])) {
            // Check if new password and confirm password match
            if ($newPassword == $confirmPassword) {
                // Update password in database
                $statement = $conn->prepare("UPDATE user SET passwort = :passwort WHERE user_id = :user_id");
                $result = $statement->execute(array('passwort' => $newPassword, 'user_id' => $userId));

                if ($result) {
                    echo "Passwort erfolgreich geändert.";
                    header('location: logout.php');
                } else {
                    echo "Fehler beim Passwort ändern.";
                }
            } else {
                echo "Die neuen Passwörter müssen übereinstimmen.";
            }
        } else {
            echo "Dein altes Passwort stimmt nicht.";
        }
    }
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
    <header>
        <?php
            include_once('navbar.php')
        ?>
    </header>
	<main>
		
        <h1>Hier kannst Du Einstellungen vornehmen</h1>
        <div class="ContainerDeckPasswort">
        <h1>Passwort ändern</h1>
            <form method="post" action="?change-password=1">
                <div class="formInputGroup">
                <input type="password" class="formInput" maxlength="250" id="old-password" name="old_password" required placeholder="Altes Passwort">
                </div>

                <div class="formInputGroup">
                <input type="password" class="formInput" maxlength="250" id="new-password" name="new_password" required placeholder="Neues Passwort">
                </div>

                <div class="formInputGroup">
                <input type="password" class="formInput" maxlength="250" id="confirm-password" name="confirm_password" required placeholder="Neues Passwort wiederholen">
                </div>

                <input class="formButton" type="submit" value="Passwort ändern">
            </form>
        </div>
        

        <div class="ContainerDeck">
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
        </div>
    </main>

    <?php
        include_once('footer.php')
    ?>
</body>
</html>