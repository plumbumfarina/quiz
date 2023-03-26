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
</head>
<body>
    <header>
        <?php
            include_once('lib/navbar.php')
        ?>
    </header>
	<main>
        <h1>Freies Spiel eröffnen</h1>
        <div class="ContainerDeck">
            <label for="modul" class="labelDeck">Wähle ein Modul aus:</label>
            <select id="modul" name="modul" class="selectDeck">
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "toor";
                        $dbname = "ProjektQuiz";
                        $user_id = $_SESSION['userid'];

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql1 = "SELECT modulname FROM modul" ;
                        $result1 = $conn->query($sql1);
                            
                        if ($result1->num_rows > 0) {
                        // output data of each row
                            while($row1 = $result1->fetch_assoc()) {
                                echo "<option>" . $row1["modulname"]. "</option>";
                            }
                        } else {
                            echo "<option> keine Module </option>";
                        }

                    ?>
            </select>
            <button class="buttonYellow"> Kartendecks filtern </button>
        </div>
    </main>
    <?php
        include_once('lib/footer.php')
    ?>
</body>
</html>