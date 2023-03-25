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
<header>
    <?php
        include_once('navbar.php');
        $kartendeck_id = $_GET['kartendeck_id'];
    ?>
</header>
<main>
    <h1> Frage hinzufügen </h1>
    <div class="ContainerDeck">
        <form id="frageHinzufuegen" method="post" onsubmit="return checkForm()" class="formDeck">   
            <label for='kartendeckID' hidden> Kartendeck ID:</label>
            <input type='text' class='inputDeck' name='kartendeck_id' value="<?php echo $kartendeck_id;?>" hidden>

            <label for='frage' class='labelDeck'> Frage:</label>
            <input type='text' class='inputDeck' name='fragentext'></input>
                                
            <label for='frage' class='labelDeck'> Antwort 1:</label>
            <div style='display: flex; align-items: center;'>
            <input type='text' class='inputDeck' name='Antwort1'></input>                 
            <input type='radio' name='richtigkeit' value='1' required> Richtige Antwort </input>
            </div>
            <br>                                
            <label for='frage' class='labelDeck'> Antwort 2:</label>
            <div style='display: flex; align-items: center;'>
            <input type='text' class='inputDeck' name='Antwort2'></input>                 
            <input type='radio' name='richtigkeit' value='2' required> Richtige Antwort </input>
            </div>
            <br>                                
            <label for='frage' class='labelDeck'> Antwort 3:</label>
            <div style='display: flex; align-items: center;'>
            <input type='text' class='inputDeck' name='Antwort3'></input>
            <input type='radio' name='richtigkeit' value='3' required> Richtige Antwort </input>
            </div>
            <br>
            <label for='frage' class='labelDeck'> Antwort 4:</label>
            <div style='display: flex; align-items: center;'>
            <input type='text' class='inputDeck' name='Antwort4'></input>
            <input type='radio' name='richtigkeit' value='4' required> Richtige Antwort </input>
            </div>
            <br>
            <button type='submit' style="width:25%;" class='buttonGreen' onclick="submitForm('lib/addFrage.php')"> Hinzufügen </button>
            <button type='submit' style="width:25%;" class='buttonGreen' onclick="submitForm('lib/addFrageAndBack.php')"> weitere Frage hinzufügen </button>
            <button type='button' style="width:25%;" class='buttonRed' onclick="openPage(<?php echo $kartendeck_id ?>)"> Abbrechen </button>
        </form>
    </div>
</main>

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
<footer>

</footer>

</body>
</html>