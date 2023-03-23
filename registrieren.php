<?php
session_start();
include('lib/dbConnector.php');
?>


<!DOCTYPE html>
<html>
<head>
  <title>Registrierung</title>
  <!-- <link rel="stylesheet" href="login-page.css"> -->
  <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
</head>
<body>

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    // Überprüfe, dass der Nickname noch nicht registriert wurde
    if(!$error) {
        $statement = $conn->prepare("SELECT * FROM user WHERE nickname = :nickname");
        $result = $statement->execute(array('nickname' => $nickname));
        $nick = $statement->fetch();

        if($nick !== false) {
            echo 'Dieser Nickname ist bereis vergeben<br>';
            $error = true;
        }
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
#        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $conn->prepare("INSERT INTO user (nickname, email, passwort) VALUES (:nickname, :email, :passwort)");
        $result = $statement->execute(array('nickname' => $nickname, 'email' => $email, 'passwort' => $passwort));
#        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash));

        if($result) {
            header("Refresh: 0.1; URL=../login.php");
#            header('location: login.php');
            echo 'Du wurdest erfolgreich registriert. In 5 Sekunden geht es zum Login.';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showFormular) {
?>
<div class="containerLogin">
        <form action="?register=1" method="post">
        <h1 class="formTitle">Registrierung</h1>
                <div class="form__input-group">
                        <input type="text" class="form__input" maxlength="250" name="nickname" autofocus placeholder="Nickname">
                </div>

                <div class="form__input-group">
                        <input type="email" class="form__input" maxlength="250" name="email" placeholder="E-Mail">
                </div>

                <div class="form__input-group">
                        <input type="password" class="form__input" maxlength="250" name="passwort" placeholder="Dein Passwort">
                </div>

                <div class="form__input-group">
                        <input type="password" class="form__input" maxlength="250" name="passwort2" placeholder="Passwort wiederholen">
                </div>

                <input class="formButton" type="submit" value="Abschicken">

                <p class="formText">
                <a class="formLink" href="login.php" id="linkLogin">Zurück zum Login</a>
            </p>
        </form>
</div>
<?php
} //Ende von if($showFormular)
?>

<?php
   include('footer.php')
?>

</body>
</html>
