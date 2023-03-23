<?php
    include('getKartendeckname.php');
    
    $servername = "localhost";
    $username = "root";
    $password = "toor";
    $dbname = "quiz";
    $user_id = $_SESSION['userid'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_SESSION['userid'])) {

            $statement = $conn->prepare("SELECT COUNT(*) as fragenAnzahl FROM fragen WHERE kartendeck_id = :kartendeck_id");
            $result = $statement->execute(array('kartendeck_id' => $kartendeck_id));

            $fragen = $statement->fetch();
            $fragenAnzahl = $fragen['fragenAnzahl'];

    } else {
        echo "ooops ... something went wrong ...";
    }
?>