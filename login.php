<?php
session_start();

include_once('lib/dbConnectorPDO.php');

if(isset($_GET['login'])) {
    $emailNickname = $_POST['emailNickname'];
    $passwort = $_POST['passwort'];

    $statement = $conn->prepare("SELECT * FROM user WHERE email = :email OR nickname = :nickname");
    $result = $statement->execute(array('email' => $emailNickname, 'nickname' => $emailNickname));
    $user = $statement->fetch();

    //Passwort überprüfen
    if ($user !== false && ($passwort == $user['passwort'])) {
        $_SESSION['userid'] = $user['user_id'];
        $_SESSION['nickname'] = $user['nickname'];
        header('location: index.php');
        die('Login erfolgreich. Weiter zur Startseite.');
    } else {
        $errorMessage = "E-Mail oder Passwort inkorrekt<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>

<body>

    <div class="containerLogin">

        <form action="?login=1" method="post">
            <h1 class="formTitle">Login</h1>
            <div class="formMessage formMessage--error"></div>

            <div class="formInputGroup">
                <input type="text" class="formInput" maxlength="250" name="emailNickname" autofocus required placeholder="E-Mail oder Nickname">
                <div class="form__input-error-message"></div>
            </div>

            <div class="formInputGroup">
                <input type="password" class="formInput" maxlength="250" name="passwort" required placeholder="Dein Passwort">
                <div class="form__input-error-message"></div>
            </div>

            <input class="formButton" type="submit" value="Einloggen">
            
            <p class="formText">
                <a class="formLink" href="registrieren.php" id="linkCreateAccount">Kein Account? Registrieren</a>
            </p>
        </form>
        
    </div>

	<?php
		include_once('footer.php')
	?>
		    
</body>

</html>
