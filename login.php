<?php
session_start();
$dbconnector = new PDO('mysql:host=localhost;dbname=quiz', 'root', 'toor');

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $retrieveUser = $dbconnector->prepare("SELECT * FROM user WHERE email = :email");
    $answer = $retrieveUser->execute(array('email' => $email));
    $user = $retrieveUser->fetch();

    //Passwort überprüfen
    if ($user !== false && ($passwort == $user['passwort'])) {
        $_SESSION['userid'] = $user['user_id'];
        die('Login erfolgreich. Weiter zu <a href=#startseite>Startseite</a>');
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
    <link rel="stylesheet" href="login-page.css">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <script defer src="login-page.js"></script>
</head>

<body>

    <div class="container__login">

        <form class="form" id="login">
            <h1 class="form__title">Login</h1>
            <div class="form__message form__message--error"></div>

            <div class="form__input-group">
                <input type="email" class="form__input" maxlength="250" name="email" autofocus placeholder="E-Mail">
                <div class="form__input-error-message"></div>
            </div>

            <div class="form__input-group">
                <input type="password" class="form__input" maxlength="250" name="passwort" placeholder="Dein Password">
                <div class="form__input-error-message"></div>
            </div>

            <input class="form__button" type="submit" value="Abschicken">
            
            <p class="form__text">
                <a class="form__link" href="registrieren.php" id="linkCreateAccount">Kein Account? Registrieren</a>
            </p>
        </form>
        
    </div>

	<?php
			include('footer.php')
		?>
		    
</body>

</html>