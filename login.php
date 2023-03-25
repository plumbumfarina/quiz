<?php
session_start();

include_once('lib/dbConnectorPDO.php');

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
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
    <!-- <link rel="stylesheet" href="login-page.css"> -->
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <script defer src="login-page.js"></script>
</head>

<body>

    <div class="containerLogin">

        <form action="?login=1" method="post">
            <h1 class="formTitle">Login</h1>
            <div class="formMessage formMessage--error"></div>

            <div class="formInputGroup">
                <input type="email" class="formInput" maxlength="250" name="email" autofocus placeholder="E-Mail">
                <div class="form__input-error-message"></div>
            </div>

            <div class="formInputGroup">
                <input type="password" class="formInput" maxlength="250" name="passwort" placeholder="Dein Password">
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
