<?php
// check if user is logged in, if not redirect to login page
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
    <title>Neue Frage</title>
</head>
<body>
<div>
<?php
    include_once('navbar.php')
?>
</div>

<?php 
    $kartendeck_id = $_GET['kartendeck_id'];
?>

<div>
    <div class="container mt-3">
        <h1> Frage hinzufügen </h1>
        <form id="frageHinzufuegen" method="post" onsubmit="return checkForm()">   
            <label for='kartendeckID' class='form-label'> Kartendeck ID:</label>
            <input type='text' class='form-control' name='kartendeck_id' value="<?php echo $kartendeck_id;?>" readonly>

            <label for='frage' class='form-label'> Frage:</label>
            <input type='text' class='form-control' name='fragentext'></input>
                                
            <label for='frage' class='form-label'> Antwort 1:</label>
            <input type='text' class='form-control' name='Antwort1'></input>                 
            <input type='radio' name='richtigkeit' value='1' required> Richtige Antwort </input>
                                
            <label for='frage' class='form-label'> Antwort 2:</label>
            <input type='text' class='form-control' name='Antwort2'></input>                 
            <input type='radio' name='richtigkeit' value='2' required> Richtige Antwort </input>
                                
            <label for='frage' class='form-label'> Antwort 3:</label>
            <input type='text' class='form-control' name='Antwort3'></input>
            <input type='radio' name='richtigkeit' value='3' required> Richtige Antwort </input>
                                
            <label for='frage' class='form-label'> Antwort 4:</label>
            <input type='text' class='form-control' name='Antwort4'></input>
            <input type='radio' name='richtigkeit' value='4' required> Richtige Antwort </input>

            <div>
                <button type='submit' class='buttonHinzufuegen' onclick="submitForm('lib/addFrage.php')"> Hinzufügen </button>
                <button type='submit' class='buttonHinzufuegenSpeziell' onclick="submitForm('lib/addFrageAndBack.php')"> weitere Frage hinzufügen </button>
                <button type='button' class='buttonLoeschen' onclick="openPage(<?php echo $kartendeck_id ?>)"> Abbrechen </button>
            </div>
        </form>
    </div>
</div>

<script>
    function checkForm() {
        var antworten = document.getElementsByName("richtigkeit");
        var hasChecked = false;
        for(var i=0; i < antworten.length; i++) {
            if(antworten[i].checked) {
                hasChecked = true;
                break;
            }
        }
        if(!hasChecked) {
            return false;
        }
        return true;
    }

    function submitForm(action) {
        if(checkForm()) {
            document.getElementById('frageHinzufuegen').setAttribute('action', action);
            document.getElementById('frageHinzufuegen').submit();
        }
    }

    function openPage(id) {
        window.location.href = "fragenUebersicht.php?kartendeck_id=" + id;
    }
</script>

</body>
</html>