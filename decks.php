<?php
// check if user is logged in, if not redirect to login page
session_start();
if(!isset($_SESSION['userid'])) {
    header('location: login.php');
    die('Bitte zuerst einloggen');
}

include('lib/getFragendeckname.php');
include('lib/getModulname.php');
include('lib/getFragenNumber.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <title>Decks</title>
</head>
<body>
<?php
    include('navbar.php')
?>


<div class=container__login">
    <h1 class="form__title">Fragendecks</h1>
    <table>
        <tr>
            <th>Deckname</th>
            <th>Kursname</th>
            <th>Anzahl Fragen</th>
        </tr>
        <tr>
            <td><?php echo $fragendeck_name; ?></td>
            <td><?php echo $modulname; ?></td>
            <td><?php echo $fragenAnzahl; ?></td>
        </tr>
        <tr>
            <td>test</td>
            <td>test</td>
            <td>test</td>
        </tr>
    </table>

<div>
<p><?php echo $fragendeck_id; ?></p>
</div>

<?php
    include('footer.php')
?>


</body>
</html>