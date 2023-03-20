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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Decks</title>
</head>
<body>
<div>
<?php
    include('navbar.php')
?>
</div>

<?php 
    $fragendeck_id = $_GET['fragendeck_id'];
?>

<div>
    <div class="container mt-3">
        <h1> Frage hinzufügen </h1>
        <form action="lib/addFrage.php" method="post">                                
            <label for='frage' class='form-label'> Frage:</label>
            <input type='text' class='form-control' name='fragentext' value=''></input>
                                
            <label for='frage' class='form-label'> Antwort 1:</label>
            <input type='text' class='form-control' name='Antwort1' value=''></input><br>                  
            <input type='radio' name='richtigkeit' value='1'>
            <label>Richtige Antwort</label><br><br>
                                
            <label for='frage' class='form-label'> Antwort 2:</label>
            <input type='text' class='form-control' name='Antwort2' value=''></input><br>                  
            <input type='radio' name='richtigkeit' value='2'>
            <label>Richtige Antwort</label><br><br>
                                
            <label for='frage' class='form-label'> Antwort 3:</label>
            <input type='text' class='form-control' name='Antwort3' value=''></input><br>
            <input type='radio' name='richtigkeit' value='3'>
            <label>Richtige Antwort</label><br><br>
                                
            <label for='frage' class='form-label'> Antwort 4:</label>
            <input type='text' class='form-control' name='Antwort4' value=''></input><br>
            <input type='radio' name='richtigkeit' value='4'>
            <label>Richtige Antwort</label><br><br>

            <div class="btn-group">
                <button type='button' class='btn btn-outline-success' onclick="openPageFrageAdd(<?php echo $fragendeck_id; ?>)"> Hinzufügen </button>
                <button type='button' class='btn btn-outline-info'> weitere Frage hinzufügen </button>
                <button type='button' class='btn btn-outline-danger'> Cancle </button>
            </div>
        </form>
    </div>
</div>

<script>
function openPageFrageAdd(id) {
    window.location.href= "addFrage.php?fragendeck_id=" + id;
}
</script>

</body>
</html>